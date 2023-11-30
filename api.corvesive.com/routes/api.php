<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\PayPeriods\PayPeriodAttributesController;
use App\Http\Controllers\PayPeriods\PayPeriodBillController;
use App\Http\Controllers\PayPeriods\PayPeriodBudgetController;
use App\Http\Controllers\PayPeriods\PayPeriodController;
use App\Http\Controllers\PayPeriods\PayPeriodMetricsController;
use App\Http\Controllers\PayPeriods\PayPeriodPaystubController;
use App\Http\Controllers\PayPeriods\PayPeriodSavingController;
use App\Http\Controllers\PaystubController;
use App\Http\Controllers\RecurringMetricsController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('account')->group(function () {
        Route::get('/', [AccountController::class, 'me'])->name('me');
        Route::put('/', [AccountController::class, 'update'])->name('account.update');
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::apiResources([
        'paystubs' => PaystubController::class,
        'pay-periods' => PayPeriodController::class,
        'bills' => BillController::class,
        'budgets' => BudgetController::class,
        'savings' => SavingController::class,
    ]);

    Route::prefix('recurring')->group(function () {
        Route::get('metrics', [RecurringMetricsController::class])->name('recurring.metrics');
    });

    Route::prefix('pay-periods/{payPeriod}')->group(function () {
        Route::get('attributes', PayPeriodAttributesController::class)->name('pay-periods.attributes');
        Route::get('metrics', PayPeriodMetricsController::class)->name('pay-periods.metrics');

        Route::prefix('paystubs')->group(function () {
            Route::get('/', [PayPeriodPaystubController::class, 'index'])->name('pay-periods.paystubs.index');
            Route::post('{paystub}', [PayPeriodPaystubController::class, 'store'])->name('pay-periods.paystubs.store');
            Route::put('{paystub}', [PayPeriodPaystubController::class, 'update'])->name('pay-periods.paystubs.update');
            Route::delete('{paystub}', [PayPeriodPaystubController::class, 'destroy'])->name('pay-periods.paystubs.destroy');
            Route::get('{payPeriodPaystub}', [PayPeriodPaystubController::class, 'show'])->name('pay-periods.paystubs.show');
        });

        Route::prefix('bills')->group(function () {
            Route::get('/', [PayPeriodBillController::class, 'index'])->name('pay-periods.bills.index');
            Route::post('{bill}', [PayPeriodBillController::class, 'store'])->name('pay-periods.bills.store');
            Route::put('{bill}', [PayPeriodBillController::class, 'update'])->name('pay-periods.bills.update');
            Route::delete('{bill}', [PayPeriodBillController::class, 'destroy'])->name('pay-periods.bills.destroy');
            Route::get('/{payPeriodBill}', [PayPeriodBillController::class, 'show'])->name('pay-periods.bills.show');
            Route::post('{payPeriodBill}/transaction', [TransactionController::class, 'billTransaction'])->name('pay-periods.bills.transaction');
        });

        Route::prefix('budgets')->group(function () {
            Route::get('/', [PayPeriodBudgetController::class, 'index'])->name('pay-periods.budgets.index');
            Route::post('{budget}', [PayPeriodBudgetController::class, 'store'])->name('pay-periods.budgets.store');
            Route::put('{budget}', [PayPeriodBudgetController::class, 'update'])->name('pay-periods.budgets.update');
            Route::delete('{budget}', [PayPeriodBudgetController::class, 'destroy'])->name('pay-periods.budgets.destroy');
            Route::get('{payPeriodBudget}', [PayPeriodBudgetController::class, 'show'])->name('pay-periods.budgets.show');
            Route::post('{payPeriodBudget}/transaction', [TransactionController::class, 'budgetTransaction'])->name('pay-periods.budgets.transaction');
        });

        Route::prefix('savings')->group(function () {
            Route::get('/', [PayPeriodSavingController::class, 'index'])->name('pay-periods.savings.index');
            Route::post('{saving}', [PayPeriodSavingController::class, 'store'])->name('pay-periods.savings.store');
            Route::put('{saving}', [PayPeriodSavingController::class, 'update'])->name('pay-periods.savings.update');
            Route::delete('{saving}', [PayPeriodSavingController::class, 'destroy'])->name('pay-periods.savings.destroy');
            Route::get('{payPeriodSaving}', [PayPeriodSavingController::class, 'show'])->name('pay-periods.savings.show');
        });

        Route::prefix('transactions')->group(function () {
            Route::get('/', [TransactionController::class, 'payPeriodTransactions'])->name('pay-periods.transactions');
            Route::post('deposits', [TransactionController::class, 'payPeriodDeposit'])->name('pay-periods.deposit');
            Route::get('/deposits', [TransactionController::class, 'payPeriodDeposits'])->name('pay-periods.deposits');
            Route::put('{transaction}', [TransactionController::class, 'update'])->name('pay-periods.transactions.update');
            Route::delete('{transaction}', [TransactionController::class, 'destroy'])->name('pay-periods.transactions.destroy');
        });
    });
});
