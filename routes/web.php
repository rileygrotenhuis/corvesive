<?php

use App\Http\Controllers\MonthlyBillController;
use App\Http\Controllers\MonthlyBudgetController;
use App\Http\Controllers\MonthlyController;
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

Route::prefix('paystubs')->group(function () {
    Route::get('/', [PaystubController::class, 'index'])->name('paystubs.index');
    Route::get('/create', [PaystubController::class, 'create'])->name('paystubs.create');
    Route::post('/', [PaystubController::class, 'store'])->name('paystubs.store');
    Route::get('/{paystub}', [PaystubController::class, 'show'])->name('paystubs.show');
    Route::put('/{paystub}', [PaystubController::class, 'update'])->name('paystubs.update');
    Route::delete('/{paystub}', [PaystubController::class, 'destroy'])->name('paystubs.destroy');
});

Route::middleware('auth')->group(function () {
    Route::prefix('monthly')->group(function () {
        Route::get('/', MonthlyController::class)->name('monthly.index');

        Route::prefix('bills')->group(function () {
            Route::get('/', [MonthlyBillController::class, 'index'])->name('monthly.bills.index');
            Route::get('/create', [MonthlyBillController::class, 'create'])->name('monthly.bills.create');
            Route::post('/', [MonthlyBillController::class, 'store'])->name('monthly.bills.store');
            Route::get('/{monthlyBill}', [MonthlyBillController::class, 'show'])->name('monthly.bills.show');
            Route::put('/{monthlyBill}', [MonthlyBillController::class, 'update'])->name('monthly.bills.update');
            Route::delete('/{monthlyBill}', [MonthlyBillController::class, 'destroy'])->name('monthly.bills.destroy');
        });

        Route::prefix('budgets')->group(function () {
            Route::get('/', [MonthlyBudgetController::class, 'index'])->name('monthly.budgets.index');
            Route::get('/create', [MonthlyBudgetController::class, 'create'])->name('monthly.budgets.create');
            Route::post('/', [MonthlyBudgetController::class, 'store'])->name('monthly.budgets.store');
            Route::get('/{monthlyBudget}', [MonthlyBudgetController::class, 'show'])->name('monthly.budgets.show');
            Route::put('/{monthlyBudget}', [MonthlyBudgetController::class, 'update'])->name('monthly.budgets.update');
            Route::delete('/{monthlyBudget}', [MonthlyBudgetController::class, 'destroy'])->name('monthly.budgets.destroy');
        });

        Route::prefix('savings')->group(function () {
            Route::get('/', [MonthlySavingController::class, 'index'])->name('monthly.savings.index');
            Route::get('/create', [MonthlySavingController::class, 'create'])->name('monthly.savings.create');
            Route::post('/', [MonthlySavingController::class, 'store'])->name('monthly.savings.store');
            Route::get('/{monthlySaving}', [MonthlySavingController::class, 'show'])->name('monthly.savings.show');
            Route::put('/{monthlySaving}', [MonthlySavingController::class, 'update'])->name('monthly.savings.update');
            Route::delete('/{monthlySaving}', [MonthlySavingController::class, 'destroy'])->name('monthly.savings.destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
