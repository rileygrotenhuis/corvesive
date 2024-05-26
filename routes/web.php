<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;

Route::get('/', fn () => inertia('Landing/Index'))->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => inertia('Dashboard/Index'))->name('dashboard');

    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
});

require __DIR__.'/auth.php';
