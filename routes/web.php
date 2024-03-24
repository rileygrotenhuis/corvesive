<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\MonthlyBillController;
use App\Http\Controllers\MonthlyBudgetController;
use App\Http\Controllers\MonthlySavingController;
use App\Http\Controllers\PayPeriodBillController;
use App\Http\Controllers\PayPeriodBudgetController;
use App\Http\Controllers\PayPeriodController;
use App\Http\Controllers\PayPeriodPaystubController;
use App\Http\Controllers\PayPeriodSavingController;
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
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('income')->group(function () {
        Route::get('/', IncomeController::class)->name('income.index');

        Route::prefix('paystubs')->group(function () {
            Route::get('/', [PaystubController::class, 'index'])->name('paystubs.index');
            Route::get('/create', [PaystubController::class, 'create'])->name('paystubs.create');
            Route::post('/', [PaystubController::class, 'store'])->name('paystubs.store');
            Route::get('/{paystub}', [PaystubController::class, 'show'])->name('paystubs.show');
            Route::put('/{paystub}', [PaystubController::class, 'update'])->name('paystubs.update');
            Route::delete('/{paystub}', [PaystubController::class, 'destroy'])->name('paystubs.destroy');
        });

        Route::prefix('deposits')->group(function () {
            Route::get('/', [DepositController::class, 'index'])->name('deposits.index');
            Route::get('/create', [DepositController::class, 'create'])->name('deposits.create');
            Route::post('/', [DepositController::class, 'store'])->name('deposits.store');
            Route::get('/{deposit}', [DepositController::class, 'show'])->name('deposits.show');
            Route::put('/{deposit}', [DepositController::class, 'update'])->name('deposits.update');
            Route::delete('/{deposit}', [DepositController::class, 'destroy'])->name('deposits.destroy');
        });
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

    Route::prefix('pay-periods')->group(function () {
        Route::get('/', [PayPeriodController::class, 'index'])->name('pay-periods.index');
        Route::post('/', [PayPeriodController::class, 'store'])->name('pay-periods.store');
        Route::get('/create', [PayPeriodController::class, 'create'])->name('pay-periods.create');

        Route::put('/{payPeriod}/current', [PayPeriodController::class, 'current'])->name('pay-periods.current');

        Route::prefix('paystubs')->group(function () {
            Route::get('/', [PayPeriodPaystubController::class, 'index'])->name('pay-period-paystubs.index');
            Route::post('/', [PayPeriodPaystubController::class, 'store'])->name('pay-period-paystubs.store');
            Route::get('/settings', [PayPeriodPaystubController::class, 'settings'])->name('pay-period-paystubs.settings');
            Route::delete('/{payPeriodPaystub}', [PayPeriodPaystubController::class, 'destroy'])->name('pay-period-paystubs.destroy');
        });

        Route::prefix('bills')->group(function () {
            Route::get('/', [PayPeriodBillController::class, 'index'])->name('pay-period-bills.index');
            Route::post('/', [PayPeriodBillController::class, 'store'])->name('pay-period-bills.store');
            Route::get('/settings', [PayPeriodBillController::class, 'settings'])->name('pay-period-bills.settings');
            Route::delete('/{payPeriodBill}', [PayPeriodBillController::class, 'destroy'])->name('pay-period-bills.destroy');
        });

        Route::prefix('budgets')->group(function () {
            Route::get('/', [PayPeriodBudgetController::class, 'index'])->name('pay-period-budgets.index');
            Route::post('/', [PayPeriodBudgetController::class, 'store'])->name('pay-period-budgets.store');
            Route::get('/settings', [PayPeriodBudgetController::class, 'settings'])->name('pay-period-budgets.settings');
            Route::delete('/{payPeriodBudget}', [PayPeriodBudgetController::class, 'destroy'])->name('pay-period-budgets.destroy');
        });

        Route::prefix('savings')->group(function () {
            Route::get('/', [PayPeriodSavingController::class, 'index'])->name('pay-period-savings.index');
            Route::post('/', [PayPeriodSavingController::class, 'store'])->name('pay-period-savings.store');
            Route::get('/settings', [PayPeriodSavingController::class, 'settings'])->name('pay-period-savings.settings');
            Route::delete('/{payPeriodSaving}', [PayPeriodSavingController::class, 'destroy'])->name('pay-period-savings.destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
