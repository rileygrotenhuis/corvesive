<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CreditAccountController;
use App\Http\Controllers\PayPeriodBillController;
use App\Http\Controllers\PayPeriodBudgetController;
use App\Http\Controllers\PayPeriodController;
use App\Http\Controllers\PayPeriodPaystubController;
use App\Http\Controllers\PaystubController;
use App\Http\Controllers\SpendingController;
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
        'credit-accounts' => CreditAccountController::class,
    ]);

    Route::prefix('pay-periods/{payPeriod}')->group(function () {
        Route::post('deposit', [TransactionController::class, 'payPeriodDeposit'])->name('pay-periods.deposit');

        Route::post('paystubs/{paystub}', [PayPeriodPaystubController::class, 'store'])->name('pay-periods.paystubs.store');
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

    Route::prefix('account')->group(function () {
        Route::get('/me', [AccountController::class, 'me'])->name('me');
        Route::put('/', [AccountController::class, 'update'])->name('account.update');
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
