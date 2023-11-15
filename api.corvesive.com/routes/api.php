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
use App\Http\Controllers\PayPeriods\PayPeriodSavingController;
use App\Http\Controllers\PaystubController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['data' => 'Corvesive']);
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('account')->group(function () {
        Route::get('/me', [AccountController::class, 'me'])->name('me');
        Route::put('/', [AccountController::class, 'update'])->name('account.update');
        Route::put('/onboard', [AccountController::class, 'onboard'])->name('account.onboard');
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::apiResources([
        'paystubs' => PaystubController::class,
        'pay-periods' => PayPeriodController::class,
        'bills' => BillController::class,
        'budgets' => BudgetController::class,
        'savings' => SavingController::class,
    ]);

    Route::get('monthly/metrics', [MonthlyMetricsController::class, 'index'])->name('monthly-metrics');

    Route::prefix('pay-periods/{payPeriod}')->group(function () {
        Route::get('dashboard', [PayPeriodDashboardController::class, 'index'])->name('pay-periods.dashboard');

        Route::get('metrics', [PayPeriodMetricsController::class, 'index'])->name('pay-periods.metrics');

        Route::post('deposit', [TransactionController::class, 'payPeriodDeposit'])->name('pay-periods.deposit');

        Route::post('complete', [PayPeriodCompleteController::class, 'complete'])->name('pay-periods.complete');
        Route::post('incomplete', [PayPeriodCompleteController::class, 'incomplete'])->name('pay-periods.incomplete');

        Route::post('current', [PayPeriodCurrentController::class, 'store'])->name('pay-periods.current');

        Route::prefix('transactions')->group(function () {
            Route::get('/', [TransactionController::class, 'payPeriodTransactions'])->name('pay-periods.transactions');
            Route::get('/deposits', [TransactionController::class, 'payPeriodDeposits'])->name('pay-periods.deposits');
            Route::put('{transaction}', [TransactionController::class, 'update'])->name('pay-periods.transactions.update');
            Route::delete('{transaction}', [TransactionController::class, 'destroy'])->name('pay-periods.transactions.destroy');
        });

        Route::prefix('paystubs')->group(function () {
            Route::get('/', [PayPeriodPaystubController::class, 'index'])->name('pay-periods.paystubs.index');
            Route::post('{paystub}', [PayPeriodPaystubController::class, 'store'])->name('pay-periods.paystubs.store');
            Route::put('{paystub}', [PayPeriodPaystubController::class, 'update'])->name('pay-periods.paystubs.update');
            Route::delete('{paystub}', [PayPeriodPaystubController::class, 'destroy'])->name('pay-periods.paystubs.destroy');
        });

        Route::prefix('bills')->group(function () {
            Route::get('/', [PayPeriodBillController::class, 'index'])->name('pay-periods.bills.index');
            Route::post('{bill}', [PayPeriodBillController::class, 'store'])->name('pay-periods.bills.store');
            Route::put('{bill}', [PayPeriodBillController::class, 'update'])->name('pay-periods.bills.update');
            Route::delete('{bill}', [PayPeriodBillController::class, 'destroy'])->name('pay-periods.bills.destroy');
            Route::post('{payPeriodBill}/transaction', [TransactionController::class, 'billTransaction'])->name('pay-periods.bills.transaction');
        });

        Route::prefix('budgets')->group(function () {
            Route::get('/', [PayPeriodBudgetController::class, 'index'])->name('pay-periods.budgets.index');
            Route::post('{budget}', [PayPeriodBudgetController::class, 'store'])->name('pay-periods.budgets.store');
            Route::put('{budget}', [PayPeriodBudgetController::class, 'update'])->name('pay-periods.budgets.update');
            Route::delete('{budget}', [PayPeriodBudgetController::class, 'destroy'])->name('pay-periods.budgets.destroy');
            Route::post('{payPeriodBudget}/transaction', [TransactionController::class, 'budgetTransaction'])->name('pay-periods.budgets.transaction');
        });

        Route::prefix('savings')->group(function () {
            Route::get('/', [PayPeriodSavingController::class, 'index'])->name('pay-periods.savings.index');
            Route::post('{saving}', [PayPeriodSavingController::class, 'store'])->name('pay-periods.savings.store');
            Route::put('{saving}', [PayPeriodSavingController::class, 'update'])->name('pay-periods.savings.update');
            Route::delete('{saving}', [PayPeriodSavingController::class, 'destroy'])->name('pay-periods.savings.destroy');
        });
    });
});
