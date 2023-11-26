<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MenuController;

// WEB
// Домашняя страница
Route ::get('/', fn() => inertia('Home')) -> name('home');
Route ::get('/public_offer', fn() => inertia('PublicOffer')) -> name('public-offer');
Route ::get('/private_policy', fn() => inertia('PrivacyPolicy')) -> name('private-policy');
Route ::get('/feedback', fn() => inertia('Feedback')) -> name('feedback');

// Ресторан
Route ::prefix('rest') -> group(function () {
    Route ::get('/', fn() => inertia('Rest/Index')) -> name('rest');
    Route ::name('rest.') -> group(function () {
        Route ::controller(MenuController::class) -> group(function () {
            Route ::get('/menu', 'index') -> name('menu');
            Route ::get('/menu/{id}', 'show') -> name('menu.show');
        });
        Route ::get('/restaurant', fn() => inertia('Rest/Restaurant')) -> name('restaurant');
        Route ::get('/kafe', fn() => inertia('Rest/SummerCafe')) -> name('cafe');
        Route ::controller(NewsController::class) -> group(function () {
            Route ::get('/news', 'index') -> name('news');
            Route ::get('/news/{id}', 'show') -> name('news.show');
        });
        Route ::get('/shefblog', fn() => inertia('Blog/Index')) -> name('blog');
    });
});

// Отель
Route ::prefix('hotel') -> group(function () {
    Route ::get('/', fn() => inertia('Hotel/Index')) -> name('hotel');
    Route ::name('hotel.') -> group(function () {
        Route ::get('/katalog-nomerov', fn() => inertia('Hotel/Catalog')) -> name('catalog');
        Route ::get('/test0', fn() => redirect() -> route('hotel')) -> name('doc');
    });
});

Route ::get('/contacts', fn() => \inertia('Contacts')) -> name("contacts");