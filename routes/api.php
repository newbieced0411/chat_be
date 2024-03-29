<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;

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

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('/register', 'new');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/show/{user}', 'show');
        Route::post('/edit/{user}', 'update');
    });

    Route::controller(ContactController::class)->prefix('contact')->group(function () {
        Route::get('/', 'index');
        Route::post('/search', 'search');
        Route::post('/add/{id}', 'new');
    });

    Route::controller(MessageController::class)->prefix('message')->group(function () {
        Route::get('/{id}', 'messages');
        Route::post('/send', 'send');
    });
});
