<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Receipt;
use App\Models\Transaction;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use Exception;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
            )
        );

        $this->apiContext->setConfig([
            'mode' => config('services.paypal.mode', 'sandbox')
        ]);
    }

    public function validateReceipt(Request $request)
    {
        $request->validate([
            'receipt_number' => 'required|string|size:6',
            'birth_date' => 'required|date'
        ]);

        $receipt = Receipt::where('receipt_number', $request->receipt_number)
            ->where('birth_date', $request->birth_date)
            ->first();

        if (!$receipt) {
            return response()->json(['error' => 'Invalid receipt details'], 404);
        }

        return response()->json($receipt);
    }

    public function create(Request $request)
    {
        $receipt = Receipt::findOrFail($request->receipt_id);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName('Receipt Payment')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($receipt->amount);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($receipt->amount);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Payment for receipt #' . $receipt->receipt_number);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.callback'))
            ->setCancelUrl(route('payment.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);

            Transaction::create([
                'receipt_id' => $receipt->id,
                'paypal_order_id' => $payment->getId(),
                'amount' => $receipt->amount,
                'status' => 'pending'
            ]);

            return response()->json([
                'id' => $payment->getId(),
                'approval_url' => $payment->getApprovalLink()
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        if (!$request->paymentId || !$request->PayerID) {
            return redirect()->route('payment.failed');
        }

        $transaction = Transaction::where('paypal_order_id', $request->paymentId)->firstOrFail();

        try {
            $payment = Payment::get($request->paymentId, $this->apiContext);
            
            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            $result = $payment->execute($execution, $this->apiContext);

            if ($result->getState() === 'approved') {
                $transaction->update([
                    'status' => 'completed',
                    'paypal_payer_id' => $request->PayerID,
                    'paid_at' => now(),
                    'paypal_response' => $result->toArray()
                ]);

                $transaction->receipt->update(['status' => 'paid']);

                return redirect()->route('payment.success');
            }
        } catch (Exception $e) {
            $transaction->update([
                'status' => 'failed',
                'paypal_response' => ['error' => $e->getMessage()]
            ]);

            return redirect()->route('payment.failed');
        }
    }

    public function generatePdf(Transaction $transaction)
    {
        $pdf = \PDF::loadView('pdf.receipt', [
            'transaction' => $transaction,
            'receipt' => $transaction->receipt
        ]);

        return $pdf->download('receipt-' . $transaction->receipt->receipt_number . '.pdf');
    }
}
