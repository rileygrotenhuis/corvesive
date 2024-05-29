<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaystubController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Landing/Index'))->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => inertia('Dashboard/Index'))->name('dashboard');

    Route::prefix('/paystubs')->group(function () {
        Route::get('/', [PaystubController::class, 'index'])->name('paystubs.index');
        Route::get('/create', [PaystubController::class, 'create'])->name('paystubs.create');
        Route::post('/', [PaystubController::class, 'store'])->name('paystubs.store');
        Route::get('/{paystub}', [PaystubController::class, 'show'])->name('paystubs.show');
        Route::put('/{paystub}', [PaystubController::class, 'update'])->name('paystubs.update');
        Route::delete('/{paystub}', [PaystubController::class, 'destroy'])->name('paystubs.destroy');
    });

    Route::prefix('/expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::put('/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
    });
});

require __DIR__.'/auth.php';
