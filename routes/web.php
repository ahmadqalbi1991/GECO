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

/*
 * Admin Routes
 */
Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/login', [Admin\AdminController::class, 'login'])->name('login');
        Route::get('/dashboard', [Admin\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [Admin\AdminController::class, 'logout'])->name('logout');
        Route::resource('/games', 'Admin\GameController');
        Route::resource('/tournaments', 'Admin\TournamentController');
    });
});

/*
 * Site Routes
 */
Route::name('site.')->group(function () {
    Route::get('/', [Site\HomeController::class, 'home'])->name('home');
    Route::get('/games', [Admin\AdminController::class, 'login'])->name('games');
});


