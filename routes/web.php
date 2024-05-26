<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Landing/Index'))->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => inertia('Dashboard/Index'))->name('dashboard');

    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');

    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
});

require __DIR__.'/auth.php';
