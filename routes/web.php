<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;

// WEB
// Домашняя страница
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacts', fn() => inertia('Contacts'))->name("contacts");
Route::get('/public_offer', fn() => inertia('PublicOffer'))->name('public-offer');
Route::get('/private_policy', fn() => inertia('PrivacyPolicy'))->name('private-policy');
Route::get('/feedback', fn() => inertia('Feedback'))->name('feedback');

// Заказ
Route::controller(OrderController::class)
    ->name('order.')
    ->prefix('/order')
    ->group(function () {
        Route::post('/', 'store')->name('create');
        Route::delete('/{id}', 'destroy')->name('cancel');
    });

// Ресторан
Route::prefix('rest')->name('rest.')->group(function () {
    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/restaurant', 'restaurant')->name('restaurant');
        Route::get('/kafe', 'summerCafe')->name('cafe');
    });
    Route::controller(MenuController::class)
        ->prefix('/menu')
        ->name('menu.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{name}', 'show')->name('show-by-category');
        });
    Route::controller(NewsController::class)->name('news.')->group(function () {
        Route::get('/news', 'index')->name('index');
        Route::get('/news/show/{id}', 'show')->name('show');
        Route::get('/news/all', 'all')->name('all');
    });
    Route::get('/shefblog', fn() => inertia('Blog/Index'))->name('blog');
});

// Отель
Route::prefix('hotel')->name('hotel.')->group(function () {
    Route::get('/', fn() => inertia('Hotel/Index'))->name('index');
    Route::get('/katalog-nomerov', fn() => inertia('Hotel/Catalog'))->name('catalog');
    Route::get('/test0', fn() => redirect()->route('hotel'))->name('doc');
});

// Для администатора
Route::prefix('admin')
    ->middleware([
        'auth',
        config('jetstream.auth_session'),
        'verified',
        'hasRole:admin',
    ])
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn() => redirect()->route('admin.news'))->name('index');
        Route::prefix('/news')
            ->controller(NewsController::class)
            ->name('news')
            ->group(function () {
                Route::get('/', 'adminShow');
                Route::post('/', 'store')->name('.store');
                Route::delete('/{id}', 'destroy')->name('.destroy');
            });
        Route::prefix('/users')
            ->controller(UserController::class)
            ->name('users')
            ->group(function () {
                Route::get('/', 'index');
                Route::put('/change-role', 'store')->name('.change-role');
                Route::delete('/{id}', 'destroy')->name('.destroy');
            });
        Route::prefix('/menu')
            ->controller(MenuController::class)
            ->name('menu.')
            ->group(function () {
                Route::get('/', 'adminShow')->name('list');
                Route::post('/menu-item', 'store')->name('store');
                Route::delete('/menu-item/{id}', 'destroy')->name('destroy');
            });
        Route::prefix('/order')
            ->controller(OrderController::class)
            ->name('order.')
            ->group(function () {
                Route::get('/', 'index')->name('list');
                Route::put('/complete', 'complete')->name('complete');
                Route::delete('/delete/{id}', 'destroy')->name('destroy');
            });

        Route::get('/pages', fn() => redirect()->route('admin.pages.rest'))->name('pages');
        Route::name('pages.')->group(function () {
            Route::get('/public-offer', fn() => inertia("Admin/PublicOffer"))
                ->name('public-offer');
            Route::get('/private-policy', fn() => inertia("Admin/PrivacyPolicy"))
                ->name('private-policy');
            Route::get('/rest', fn() => inertia("Admin/Rest"))->name('rest');
            Route::get('/cafe', fn() => inertia("Admin/Cafe"))->name('cafe');
            Route::get('/restaurant', fn() => inertia("Admin/Restaurant"))->name('restaurant');
        });
    });
