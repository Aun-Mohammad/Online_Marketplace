<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\PreventBackButtonAfterLogout;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SellerMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->group(function () {
        Route::get('/', 'login_view')->name('login');
        Route::post('/', 'login');
        Route::get('register', 'register_view')->name('register');
        Route::post('register', 'register');
    });

    Route::middleware([Authenticate::class, PreventBackButtonAfterLogout::class])->group(function () {
        Route::get('logout', 'logout')->name('logout');
    });
});

Route::middleware([Authenticate::class, PreventBackButtonAfterLogout::class])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('seller-dashboard', 'seller')->name('seller-dashboard')->middleware(SellerMiddleware::class);
        Route::get('buyer-dashboard', 'buyer')->name('buyer-dashboard')->middleware(BuyerMiddleware::class);
    });

    Route::controller(ProductController::class)->group(function () {
        Route::prefix('seller/product')->name('seller.product.')->group(function () {
            Route::get('create', 'create')->name('create');
            Route::post('create', 'store');
            // Route::get('view', 'view')->name('view');
            Route::get('{product}/view', 'view')->name('view');
            Route::get('{product}/edit', 'edit')->name('edit');
            Route::patch('{product}/edit', 'update');
            Route::delete('{product}/destroy', 'destroy')->name('destroy');
        });
    });

    Route::controller(OrderController::class)->group(function () {
        Route::prefix('seller/product')->name('seller.product.')->group(function () {
            Route::get('order', 'view_placed_order')->name('view_placed_order');
        });
    });


    //BUYER ROUTES

    Route::controller(ProductController::class)->group(function () {
        Route::prefix('buyer/product')->name('buyer.product.')->group(function () {
            Route::get('{product}/view', 'buyer_view')->name('view');
        });
    });

    Route::controller(OrderController::class)->group(function () {
        Route::prefix('buyer/product')->name('buyer.product.')->group(function () {
            Route::get('{product}/order', 'order')->name('order');
            Route::post('place_order', 'place_order')->name('place_order');
        });
    });
});
