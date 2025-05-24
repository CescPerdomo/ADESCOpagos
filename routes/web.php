<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", [PaymentController::class, "dashboard"])
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(function () {
    // Rutas de perfil
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");

    // Rutas de pagos
    Route::prefix("payment")->group(function () {
        Route::get("/form", [PaymentController::class, "showPaymentForm"])->name("payment.form");
        Route::post("/process", [PaymentController::class, "processPayment"])->name("payment.process");
        Route::get("/success", [PaymentController::class, "success"])->name("payment.success");
        Route::get("/cancel", [PaymentController::class, "cancel"])->name("payment.cancel");
    });

    // Rutas de recibos
    Route::get("/receipt/{receipt}/download", [PaymentController::class, "downloadReceipt"])
        ->name("receipt.download");

    // Rutas de administración
    Route::middleware("admin")->prefix("admin")->group(function () {
        Route::get("/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");
        Route::get("/users", [AdminController::class, "manageUsers"])->name("admin.users");
        Route::get("/reports", [AdminController::class, "generateReports"])->name("admin.reports");
        Route::get("/settings", [AdminController::class, "systemSettings"])->name("admin.settings");
    });
});

require __DIR__."/auth.php";
