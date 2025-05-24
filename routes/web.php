<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Routes
Route::post('/validate-receipt', [PaymentController::class, 'validateReceipt'])
    ->name('receipt.validate');

// Auth Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payment Routes
    Route::prefix('payment')->group(function () {
        Route::post('/create', [PaymentController::class, 'create'])->name('payment.create');
        Route::get('/callback', [PaymentController::class, 'callback'])->name('payment.callback');
        Route::get('/cancel', function () {
            return redirect()->route('home')->with('error', 'Payment was cancelled.');
        })->name('payment.cancel');
        Route::get('/failed', function () {
            return redirect()->route('home')->with('error', 'Payment failed.');
        })->name('payment.failed');
        Route::get('/success', function () {
            return redirect()->route('home')->with('success', 'Payment completed successfully.');
        })->name('payment.success');
        Route::get('/{transaction}/pdf', [PaymentController::class, 'generatePdf'])
            ->name('payment.pdf');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
});

require __DIR__.'/auth.php';
