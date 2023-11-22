<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    -> group(function () {
        Route ::get('/dashboard', function () {
            return Inertia ::render('Dashboard');
        }) -> name('dashboard');
    });

Route::get('/', fn() => inertia('Home')) -> name('home');

Route::get('/rest', fn() => inertia('Rest/Index')) -> name('rest');

Route::get('/hotel', fn() => inertia('Hotel')) -> name('hotel');
