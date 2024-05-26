<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Landing/Index'))->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => inertia('Dashboard/Index'))->name('dashboard');
});

require __DIR__.'/auth.php';
