<?php

use App\Http\Controllers\Expenses\ExpenseController;
use App\Http\Controllers\Expenses\MonthlyExpenseController;
use App\Http\Controllers\Paystubs\MonthlyPaystubController;
use App\Http\Controllers\Paystubs\PaystubController;
use App\Http\Controllers\Transactions\DepositController;
use App\Http\Controllers\Transactions\PaymentController;
use Illuminate\Support\Facades\Route;

/** Landing Page */
Route::get('/', fn () => inertia('Landing/Index'))->name('home');

Route::middleware('auth')->group(function () {
    /** Dashboard Page */
    Route::get('/dashboard', fn () => inertia('ComingSoon'))->name('dashboard');

    /** Calendar Page (Coming Soon) */
    Route::get('/calendar', fn () => inertia('ComingSoon'))->name('calendar');

    Route::prefix('/paystubs')->group(function () {
        /** Paystub Routes */
        Route::get('/', [PaystubController::class, 'index'])->name('paystubs.index');
        Route::get('/create', [PaystubController::class, 'create'])->name('paystubs.create');
        Route::post('/', [PaystubController::class, 'store'])->name('paystubs.store');
        Route::get('/{paystub}', [PaystubController::class, 'show'])->name('paystubs.show');
        Route::put('/{paystub}', [PaystubController::class, 'update'])->name('paystubs.update');
        Route::delete('/{paystub}', [PaystubController::class, 'destroy'])->name('paystubs.destroy');

        /** Monthly Paystub Routes */
        Route::get('/due/{monthlyPaystub}', [MonthlyPaystubController::class, 'show'])->name('monthly-paystubs.show');
        Route::put('monthly-paystubs/{monthlyPaystub}', [MonthlyPaystubController::class, 'update'])->name('monthly-paystubs.update');
        Route::put('monthly-paystubs/{monthlyPaystub}/reschedule', [MonthlyPaystubController::class, 'reschedule'])->name('monthly-paystubs.reschedule');
        Route::delete('monthly-paystubs/{monthlyPaystub}/unschedule', [MonthlyPaystubController::class, 'unschedule'])->name('monthly-paystubs.unschedule');
        Route::post('monthly-paystubs/{monthlyPaystub}/deposit', [MonthlyPaystubController::class, 'deposit'])->name('monthly-paystubs.deposit');
    });

    Route::prefix('/expenses')->group(function () {
        /** Expense Routes */
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::put('/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

        /** Monthly Expense Routes */
        Route::get('/due/{monthlyExpense}', [MonthlyExpenseController::class, 'show'])->name('monthly-expenses.show');
        Route::put('monthly-expenses/{monthlyExpense}', [MonthlyExpenseController::class, 'update'])->name('monthly-expenses.update');
        Route::put('monthly-expenses/{monthlyExpense}/reschedule', [MonthlyExpenseController::class, 'reschedule'])->name('monthly-expenses.reschedule');
        Route::delete('monthly-expenses/{monthlyExpense}/unschedule', [MonthlyExpenseController::class, 'unschedule'])->name('monthly-expenses.unschedule');
        Route::post('monthly-expenses/{monthlyExpense}/payment', [MonthlyExpenseController::class, 'payment'])->name('monthly-expenses.payment');
    });

    /** Payment Routes */
    Route::prefix('/payments')->group(function () {
        Route::delete('/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    });

    /** Deposit Routes */
    Route::prefix('/deposits')->group(function () {
        Route::delete('/{deposit}', [DepositController::class, 'destroy'])->name('deposits.destroy');
    });
});

require __DIR__.'/auth.php';
