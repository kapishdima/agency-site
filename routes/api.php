<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group([
    'middleware' => 'auth:sanctum',
], function ($router) {
    Route::resource('media', 'MediaAPIController');
    Route::resource('settings', 'SettingsAPIController')->only(['show', 'update']);
    Route::resource('locales', 'LocaleAPIController')->only(['index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function () {
    return auth()->user();
});
