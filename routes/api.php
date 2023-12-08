<?php

use App\Http\Controllers\ClientAccountController;
use App\Http\Controllers\ClientRemoveClaimController;
use App\Http\Controllers\ClientStoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\FrontMusicKitController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth.api'], function ($router) {
    Route::post('agree', [UserController::class, 'agree']);
});

Route::get('music', [MusicController::class, 'search']);
Route::get('playlist', [PlaylistController::class, 'search']);
Route::get('music_kit', [FrontMusicKitController::class, 'search']);

Route::group(['middleware' => 'json.response'], function () {
    Route::group(['prefix' => 'favorite'], function () {
        Route::post('agree', [FavoriteController::class, 'agree']);
        Route::post('create', [FavoriteController::class, 'create']);
        Route::post('delete', [FavoriteController::class, 'destroy']);
    });

    Route::post('remove-claim', [ClientRemoveClaimController::class, 'store']);
    Route::apiResource('account', ClientAccountController::class)->only(['store', 'destroy']);

    Route::post('story', [ClientStoryController::class, 'store']);
});
// Route::get('test', function ($request) {
//     return response()->json(auth());
// });
