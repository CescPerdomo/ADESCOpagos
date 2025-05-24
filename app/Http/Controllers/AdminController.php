<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $transactions = Transaction::with(['receipt.user'])
            ->latest()
            ->paginate(10);

        $totalRevenue = Transaction::where('status', 'completed')
            ->sum('amount');

        $completedPayments = Transaction::where('status', 'completed')
            ->count();

        $pendingPayments = Transaction::where('status', 'pending')
            ->count();

        return view('admin.dashboard', compact(
            'transactions',
            'totalRevenue',
            'completedPayments',
            'pendingPayments'
        ));
    }
}
