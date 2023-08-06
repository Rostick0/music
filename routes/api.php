<?php

use App\Http\Controllers\MusicController;
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

Route::group(['middleware' => 'auth'], function ($router) {
    Route::put('agree', [UserController::class, 'agree']);
});

Route::get('music', [MusicController::class, 'search']);
Route::get('playlist', [PlaylistController::class, 'search']);


Route::get('test', function ($request) {
    return response()->json(auth());
});
