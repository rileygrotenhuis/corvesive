<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Index'))->name('home');
