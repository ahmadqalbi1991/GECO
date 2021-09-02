<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Site;
use App\Http\Controllers\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

/*
 * Auth routes
*/
Route::post('login', [Auth\AuthController::class, 'login'])->name('login');
Route::get('logout', [Auth\AuthController::class, 'logout'])->name('logout');
Route::post('register', [Auth\AuthController::class, 'register'])->name('register');
Route::post('/get-pubg-player', [Site\TournamentController::class, 'getPlayerDetail']);

/*
 * Admin Routes
 */
Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login', [Admin\AdminController::class, 'login'])->name('login');
        Route::get('/dashboard', [Admin\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [Admin\AdminController::class, 'logout'])->name('logout');
        Route::resource('/games', 'Admin\GameController');
        Route::resource('/tournaments', 'Admin\TournamentController');
        Route::resource('/products', 'Admin\ProductController');
        Route::resource('/setting', 'Admin\SettingController');
        Route::get('/orders', [Admin\OrderController::class, 'index'])->name('orders.index');
        Route::post('/change-order-status', [Admin\OrderController::class, 'changeStatus'])->name('order-change-status');
});

/*
 * Site Routes
 */
Route::name('site.')->group(function () {
    Route::get('/', [Site\HomeController::class, 'home'])->name('home');
    Route::get('/games', [Admin\AdminController::class, 'login'])->name('games');
    Route::get('/tournaments', [Site\HomeController::class, 'tournaments'])->name('tournaments');
    Route::name('user.')->group(function () {
        Route::get('/user-verify/{code}/{id}', [Auth\AuthController::class, 'verify'])->name('verify');
        Route::get('/login', [Site\UserController::class, 'login'])->name('login');
        Route::get('/register', [Site\UserController::class, 'register'])->name('register');
        Route::get('/not-verified/{id}', [Site\UserController::class, 'notVerified'])->name('not_verified');
        Route::get('/verified', [Site\UserController::class, 'verified'])->name('verified');
    });
    Route::name('tournament.')->group(function () {
        Route::get('/tournament/{id}', [Site\TournamentController::class, 'tournamentDetail'])->name('detail');
        Route::get('/tournament/register/{id}', [Site\TournamentController::class, 'tournamentRegister'])->name('register');
    });
    Route::get('add-cart/{id}', [Site\HomeController::class, 'addCart'])->name('add-cart');
    Route::get('remove-cart-item/{id}', [Site\HomeController::class, 'removeCartItem'])->name('remove-cart-item');
    Route::get('/cart', [Site\HomeController::class, 'cart'])->name('cart');
    Route::post('/update-cart', [Site\HomeController::class, 'updateCart'])->name('update-cart');
    Route::get('/checkout', [Site\HomeController::class, 'checkout'])->name('checkout');
    Route::post('/create-order', [Site\HomeController::class, 'updateShipment'])->name('update-shipment');
    Route::get('/payment-success/{order_number}/{id}', [Site\HomeController::class, 'successCart'])->name('cart-success');
    Route::get('/blog/{id}', [Site\HomeController::class, 'blog'])->name('blog');
    Route::get('/download-shop-invoice/{id}', [Site\HomeController::class, 'downloadShopInvoice'])->name('download-shop-invoice');
});
Route::post('/get-pubg-player', [Site\TournamentController::class, 'getPlayerDetail']);


