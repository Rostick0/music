<?php

use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlaylistController;
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

Route::get('/{url}', [SitePageController::class, 'index']);

// ,'middleware' => 'auth'
Route::group(['prefix' => 'admin'], function ($router) {
    Route::get('music_list', [MusicController::class, 'show'])->name('music.list');
    Route::get('music_create', [MusicController::class, 'show_create'])->name('music.create');
    Route::post('music_create', [MusicController::class, 'create']);
    Route::get('music/{id}', [MusicController::class, 'show_edit'])->name('music.edit');
    Route::post('music/{id}', [MusicController::class, 'create']);
    Route::get('music_kit/{id}', [SiteController::class, 'show'])->name('music_kit');
    Route::get('playlist_list', [PlaylistController::class, 'show'])->name('playlist');
    Route::get('playlist/{id}', [PlaylistController::class, 'show_edit'])->name('playlist.edit');
    Route::get('statistic', [StatisticController::class, 'show'])->name('statistic');
    Route::get('subscriptions', [SubscriptionController::class, 'show'])->name('subscriptions');
    Route::get('users', [UserController::class, 'show'])->name('users');
    Route::get('settings', [SiteController::class, 'show'])->name('settings');
});