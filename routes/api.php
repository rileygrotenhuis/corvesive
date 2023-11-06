<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\MonthlyMetricsController;
use App\Http\Controllers\PayPeriods\PayPeriodBillController;
use App\Http\Controllers\PayPeriods\PayPeriodBudgetController;
use App\Http\Controllers\PayPeriods\PayPeriodCompleteController;
use App\Http\Controllers\PayPeriods\PayPeriodController;
use App\Http\Controllers\PayPeriods\PayPeriodCurrentController;
use App\Http\Controllers\PayPeriods\PayPeriodDashboardController;
use App\Http\Controllers\PayPeriods\PayPeriodMetricsController;
use App\Http\Controllers\PayPeriods\PayPeriodPaystubController;
use App\Http\Controllers\PaystubController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['data' => 'Corvesive']);
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResources([
        'paystubs' => PaystubController::class,
        'pay-periods' => PayPeriodController::class,
        'bills' => BillController::class,
        'budgets' => BudgetController::class,
    ]);

    Route::prefix('pay-periods/{payPeriod}')->group(function () {
        Route::get('dashboard', [PayPeriodDashboardController::class, 'index'])->name('pay-periods.dashboard');

        Route::get('metrics', [PayPeriodMetricsController::class, 'index'])->name('pay-periods.metrics');

        Route::post('deposit', [TransactionController::class, 'payPeriodDeposit'])->name('pay-periods.deposit');

        Route::post('complete', [PayPeriodCompleteController::class, 'complete'])->name('pay-periods.complete');
        Route::post('incomplete', [PayPeriodCompleteController::class, 'incomplete'])->name('pay-periods.incomplete');

        Route::post('current', [PayPeriodCurrentController::class, 'store'])->name('pay-periods.current');

        Route::get('transactions', [TransactionController::class, 'payPeriodTransactions'])->name('pay-periods.transactions');
        Route::put('transactions/{transaction}', [TransactionController::class, 'update'])->name('pay-periods.transactions.update');
        Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy'])->name('pay-periods.transactions.destroy');

        Route::post('paystubs/{paystub}', [PayPeriodPaystubController::class, 'store'])->name('pay-periods.paystubs.store');
        Route::put('paystubs/{paystub}', [PayPeriodPaystubController::class, 'update'])->name('pay-periods.paystubs.update');
        Route::delete('paystubs/{paystub}', [PayPeriodPaystubController::class, 'destroy'])->name('pay-periods.paystubs.destroy');

        Route::post('bills/{bill}', [PayPeriodBillController::class, 'store'])->name('pay-periods.bills.store');
        Route::put('bills/{bill}', [PayPeriodBillController::class, 'update'])->name('pay-periods.bills.update');
        Route::delete('bills/{bill}', [PayPeriodBillController::class, 'destroy'])->name('pay-periods.bills.destroy');
        Route::post('bills/{payPeriodBill}/transaction', [TransactionController::class, 'billTransaction'])->name('pay-periods.bills.transaction');

        Route::post('budgets/{budget}', [PayPeriodBudgetController::class, 'store'])->name('pay-periods.budgets.store');
        Route::put('budgets/{budget}', [PayPeriodBudgetController::class, 'update'])->name('pay-periods.budgets.update');
        Route::delete('budgets/{budget}', [PayPeriodBudgetController::class, 'destroy'])->name('pay-periods.budgets.destroy');
        Route::post('budgets/{payPeriodBudget}/transaction', [TransactionController::class, 'budgetTransaction'])->name('pay-periods.budgets.transaction');
    });

    Route::get('monthly/metrics', [MonthlyMetricsController::class, 'index'])->name('monthly-metrics');

    Route::prefix('account')->group(function () {
        Route::get('/me', [AccountController::class, 'me'])->name('me');
        Route::put('/', [AccountController::class, 'update'])->name('account.update');
        Route::put('/onboard', [AccountController::class, 'onboard'])->name('account.onboard');
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
