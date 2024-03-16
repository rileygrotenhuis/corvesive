<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\MonthlyBillController;
use App\Http\Controllers\MonthlyBudgetController;
use App\Http\Controllers\MonthlySavingController;
use App\Http\Controllers\PaystubController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::prefix('income')->group(function () {
        // TODO: Income Dashboard

        Route::prefix('paystubs')->group(function () {
            Route::get('/', [PaystubController::class, 'index'])->name('paystubs.index');
            Route::get('/create', [PaystubController::class, 'create'])->name('paystubs.create');
            Route::post('/', [PaystubController::class, 'store'])->name('paystubs.store');
            Route::get('/{paystub}', [PaystubController::class, 'show'])->name('paystubs.show');
            Route::put('/{paystub}', [PaystubController::class, 'update'])->name('paystubs.update');
            Route::delete('/{paystub}', [PaystubController::class, 'destroy'])->name('paystubs.destroy');
        });

        // TODO: Deposits
    });

    Route::prefix('expenses')->group(function () {
        Route::get('/', ExpensesController::class)->name('expenses.index');

        Route::prefix('bills')->group(function () {
            Route::get('/', [MonthlyBillController::class, 'index'])->name('bills.index');
            Route::get('/create', [MonthlyBillController::class, 'create'])->name('bills.create');
            Route::post('/', [MonthlyBillController::class, 'store'])->name('bills.store');
            Route::get('/{monthlyBill}', [MonthlyBillController::class, 'show'])->name('bills.show');
            Route::put('/{monthlyBill}', [MonthlyBillController::class, 'update'])->name('bills.update');
            Route::delete('/{monthlyBill}', [MonthlyBillController::class, 'destroy'])->name('bills.destroy');
        });

        Route::prefix('budgets')->group(function () {
            Route::get('/', [MonthlyBudgetController::class, 'index'])->name('budgets.index');
            Route::get('/create', [MonthlyBudgetController::class, 'create'])->name('budgets.create');
            Route::post('/', [MonthlyBudgetController::class, 'store'])->name('budgets.store');
            Route::get('/{monthlyBudget}', [MonthlyBudgetController::class, 'show'])->name('budgets.show');
            Route::put('/{monthlyBudget}', [MonthlyBudgetController::class, 'update'])->name('budgets.update');
            Route::delete('/{monthlyBudget}', [MonthlyBudgetController::class, 'destroy'])->name('budgets.destroy');
        });

        Route::prefix('savings')->group(function () {
            Route::get('/', [MonthlySavingController::class, 'index'])->name('savings.index');
            Route::get('/create', [MonthlySavingController::class, 'create'])->name('savings.create');
            Route::post('/', [MonthlySavingController::class, 'store'])->name('savings.store');
            Route::get('/{monthlySaving}', [MonthlySavingController::class, 'show'])->name('savings.show');
            Route::put('/{monthlySaving}', [MonthlySavingController::class, 'update'])->name('savings.update');
            Route::delete('/{monthlySaving}', [MonthlySavingController::class, 'destroy'])->name('savings.destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
