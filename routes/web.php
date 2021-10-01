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
    Route::resource('/blogs', 'Admin\BlogController');
    Route::get('/messages', [Admin\MessageController::class, 'index'])->name('messages');
    Route::get('/subscribers', [Admin\SubscriberController::class, 'index'])->name('subscribers');
    Route::get('/message-view/{id}', [Admin\MessageController::class, 'view'])->name('message.view');
    Route::get('/message-reply/{id}', [Admin\MessageController::class, 'reply'])->name('message.reply');
    Route::get('/message-delete/{id}', [Admin\MessageController::class, 'delete'])->name('message.delete');
    Route::post('/reply', [Admin\MessageController::class, 'sendMessage'])->name('send.message');
    Route::resource('/setting', 'Admin\SettingController');
    Route::get('/orders', [Admin\OrderController::class, 'index'])->name('orders.index');
    Route::post('/change-order-status', [Admin\OrderController::class, 'changeStatus'])->name('order-change-status');
    Route::name('team.')->group(function () {
        Route::get('/teams', [Admin\TeamController::class, 'index'])->name('index');
        Route::get('/team-view/{id}', [Admin\TeamController::class, 'view'])->name('view');
        Route::post('/set-slot-number', [Admin\TeamController::class, 'setSlotNumber'])->name('set-slot');
        Route::post('/save-team', [Admin\TeamController::class, 'saveTeam'])->name('update');
        Route::post('/wrong-username-mail', [Admin\TeamController::class, 'wrongUsername'])->name('send-wrong-user-mail');
        Route::get('/send-users/{id}', [Admin\TeamController::class, 'sendUsersEmail'])->name('send-users-email');
    });
    Route::get('/leader-board', [Admin\TournamentController::class, 'leaderboard'])->name('leaderboard');
});

/*
 * Site Routes
 */
Route::name('site.')->group(function () {
    Route::get('/', [Site\HomeController::class, 'home'])->name('home');
    Route::get('/games', [Admin\AdminController::class, 'login'])->name('games');
    Route::get('/tournaments', [Site\HomeController::class, 'tournaments'])->name('tournaments');
    Route::get('/shop', [Site\HomeController::class, 'shop'])->name('shop');
    Route::get('/about-us', [Site\HomeController::class, 'aboutUs'])->name('about');
    Route::get('/terms-and-conditions', [Site\HomeController::class, 'terms'])->name('terms');
    Route::get('/privacy-policy', [Site\HomeController::class, 'privacy'])->name('privacy');
    Route::get('/contact-us', [Site\HomeController::class, 'contactUs'])->name('contact');
    Route::post('/send-message', [Site\HomeController::class, 'sendMessage'])->name('send-message');
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
        Route::post('/tournament/pay', [Site\TournamentController::class, 'payTournament'])->name('pay');
        Route::name('team.')->group(function () {
            Route::get('/tournament-joined-team/{id}', [Site\TournamentController::class, 'teamView'])->name('view');
            Route::get('/team-edit/{id}', [Site\TournamentController::class, 'editPlayer'])->name('edit');
            Route::get('/wrong-username/{id}', [Site\TournamentController::class, 'changeUsername'])->name('change-username');
            Route::post('/update-username', [Site\TournamentController::class, 'updateUsername'])->name('update-username');
        });
    });
    Route::get('add-cart/{id}', [Site\HomeController::class, 'addCart'])->name('add-cart');
    Route::get('remove-cart-item/{id}', [Site\HomeController::class, 'removeCartItem'])->name('remove-cart-item');
    Route::get('/cart', [Site\HomeController::class, 'cart'])->name('cart');
    Route::post('/update-cart', [Site\HomeController::class, 'updateCart'])->name('update-cart');
    Route::get('/checkout', [Site\HomeController::class, 'checkout'])->name('checkout');
    Route::post('/create-order', [Site\HomeController::class, 'updateShipment'])->name('update-shipment');
    Route::get('/payment-success/{order_number}/{id}', [Site\HomeController::class, 'successCart'])->name('cart-success');
    Route::get('/games-posts', [Site\HomeController::class, 'blogs'])->name('blogs');
    Route::get('/blog/{id}', [Site\HomeController::class, 'blog'])->name('blog');
    Route::get('/download-shop-invoice/{id}', [Site\HomeController::class, 'downloadShopInvoice'])->name('download-shop-invoice');
    Route::post('/subscribe', [Site\HomeController::class, 'subscribe'])->name('subscribe');
    Route::get('/my-profile', [Site\HomeController::class, 'myProfile'])->name('my-profile');
    Route::get('/my-orders', [Site\HomeController::class, 'myOrders'])->name('my-orders');
    Route::get('/my-tournaments', [Site\HomeController::class, 'myTournaments'])->name('my-tournaments');
    Route::post('/update-user/{id}', [Site\HomeController::class, 'updateUser'])->name('update-user');
});
Route::post('/get-pubg-player', [Site\TournamentController::class, 'getPlayerDetail']);

Route::get('/migrate', function () {
    Artisan::call('migrate');
    echo 'Migrated';
});

Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('session:table');
    echo 'Clear';
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    echo 'Storage Link';
});



