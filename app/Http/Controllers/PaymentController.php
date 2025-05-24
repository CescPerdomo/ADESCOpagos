<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

/**
 * Controlador de Pagos con PayPal
 */
class PaymentController extends Controller
{
    private $client;

    public function __construct()
    {
        $environment = new SandboxEnvironment(
            config("services.paypal.client_id"),
            config("services.paypal.secret")
        );
        $this->client = new PayPalHttpClient($environment);

        // Aplicar middleware de autenticación
        $this->middleware('auth');
    }

    /**
     * Muestra el dashboard con las transacciones del usuario.
     */
    public function dashboard()
    {
        $transactions = Transaction::with('receipt')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('transactions'));
    }

    /**
     * Muestra el formulario de pago.
     */
    public function showPaymentForm()
    {
        return view("payment.form");
    }

    /**
     * Procesa el pago de PayPal.
     */
    public function processPayment(Request $request)
    {
        try {
            // Validar la solicitud
            $validated = $request->validate([
                "order_id" => "required|string",
                "payment_details" => "required|array",
                "amount" => "required|numeric|min:0.01",
                "description" => "required|string"
            ]);

            // Obtener los detalles del pago de PayPal
            $ordersCaptureRequest = new OrdersGetRequest($validated["order_id"]);
            $response = $this->client->execute($ordersCaptureRequest);

            // Verificar el estado del pago
            if ($response->result->status !== "COMPLETED") {
                return response()->json([
                    "success" => false,
                    "message" => "El pago no se completó correctamente"
                ], 400);
            }

            // Crear la transacción
            $transaction = Transaction::create([
                "user_id" => auth()->id(),
                "amount" => $validated["amount"],
                "currency" => $response->result->purchase_units[0]->amount->currency_code,
                "status" => "completed",
                "payment_method" => "paypal",
                "metadata" => [
                    "paypal_order_id" => $validated["order_id"],
                    "payment_details" => $validated["payment_details"],
                    "description" => $validated["description"]
                ]
            ]);

            // Generar el recibo
            $receipt = Receipt::create([
                "transaction_id" => $transaction->id,
                "receipt_number" => "REC-" . str_pad($transaction->id, 8, "0", STR_PAD_LEFT),
                "status" => "generated",
                "metadata" => [
                    "payment_method" => "paypal",
                    "description" => $validated["description"]
                ]
            ]);

            // Generar el PDF del recibo
            $receipt->generatePDF();

            return response()->json([
                "success" => true,
                "transaction_id" => $transaction->id,
                "message" => "Pago procesado correctamente"
            ]);

        } catch (HttpException $e) {
            Log::error("Error de PayPal: " . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Error al procesar el pago con PayPal"
            ], 500);
        } catch (\Exception $e) {
            Log::error("Error general: " . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Error al procesar el pago"
            ], 500);
        }
    }

    /**
     * Muestra la página de éxito del pago.
     */
    public function success(Request $request)
    {
        $transaction = Transaction::with("receipt")
            ->findOrFail($request->query("transaction_id"));

        return view("payment.success", compact("transaction"));
    }

    /**
     * Maneja la cancelación del pago.
     */
    public function cancel()
    {
        return redirect()->route("dashboard")
            ->with("error", "El pago ha sido cancelado");
    }

    /**
     * Descarga el recibo en formato PDF.
     */
    public function downloadReceipt(Receipt $receipt)
    {
        // Verificar que el usuario tenga acceso al recibo
        if ($receipt->transaction->user_id !== auth()->id() && !auth()->user()->hasRole("admin")) {
            abort(403, "No tienes permiso para descargar este recibo");
        }

        // Verificar que el archivo exista
        $pdfPath = "receipts/{$receipt->receipt_number}.pdf";
        if (!Storage::exists($pdfPath)) {
            // Si no existe, intentar generarlo
            $receipt->generatePDF();
            
            if (!Storage::exists($pdfPath)) {
                abort(404, "El archivo del recibo no se encuentra disponible");
            }
        }

        return Storage::download($pdfPath, "recibo-{$receipt->receipt_number}.pdf", [
            "Content-Type" => "application/pdf"
        ]);
    }
}
