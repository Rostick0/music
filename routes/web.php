<?php

use App\Http\Controllers\ClientRemoveClaimController;
use App\Http\Controllers\ClientStatisticController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RemoveClaimController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SitePageController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// ,'middleware' => 'auth'
Route::group(['prefix' => 'admin'], function ($router) {
    Route::group(['prefix' => 'music'], function ($router) {
        Route::get('list', [MusicController::class, 'index'])->name('music.list');
        Route::get('create', [MusicController::class, 'create'])->name('music.create');
        Route::post('create', [MusicController::class, 'store']);
        Route::get('{id}', [MusicController::class, 'edit'])->name('music.edit');
        Route::post('{id}', [MusicController::class, 'create']);
    });

    Route::get('music_kit/{id}', [SiteController::class, 'show'])->name('music_kit');

    Route::group(['prefix' => 'playlist'], function ($router) {
        Route::get('list', [PlaylistController::class, 'index'])->name('playlist');
        Route::get('create', [PlaylistController::class, 'create'])->name('playlist.create');
        Route::get('{id}', [PlaylistController::class, 'edit'])->name('playlist.edit');
    });

    Route::get('statistic', [StatisticController::class, 'index'])->name('statistic');
    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions');

    Route::group(['prefix' => 'users'], function ($router) {
        Route::get('/', [UserController::class, 'index'])->name('users');
        // Route::get('{id}', [UserController::class, 'show'])->name('users');
    });

    Route::get('settings', [SiteController::class, 'index'])->name('settings');

    Route::group(['prefix' => 'pages'], function ($router) {
        Route::get('list', [SitePageController::class, 'show'])->name('page.list');
        Route::get('create', [SitePageController::class, 'create'])->name('page.create');
        Route::post('create', [SitePageController::class, 'store']);
        Route::get('{id}', [SitePageController::class, 'edit'])->name('page.edit');
        Route::post('{id}', [SitePageController::class, 'update']);
    });
});

Route::group(['prefix' => 'client'], function ($router) {
    Route::get('music', [MusicController::class, 'index_client'])->name('client.music');

    Route::get('subscriptions', [ClientSubscriptionController::class, 'index'])->name('client.subscriptions');

    Route::get('statistic', [ClientStatisticController::class, 'index'])->name('client.statistic');

    Route::get('remove_claim', [ClientRemoveClaimController::class, 'index'])->name('client.remove_claim');
    Route::post('remove_claim', [ClientRemoveClaimController::class, 'store']);

    Route::get('profile', [UserController::class, 'show'])->name('client.profile');
    Route::get('profile_edit', [UserController::class, 'edit'])->name('client.profile.edit');
    Route::post('profile_edit', [UserController::class, 'update']);
    Route::post('profile_password', [UserController::class, 'password_update']);
});

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'store_login']);

Route::get('register', [RegisterController::class, 'show'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

Route::get('{url}', [SitePageController::class, 'index']);
Route::get('{url}/{id}', [SitePageController::class, 'index']);
