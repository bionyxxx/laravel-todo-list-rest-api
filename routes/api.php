<?php

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

Route::get('/', function () {
    return response()->json([
        'message' => 'Hello World!'
    ]);
});

Route::middleware('guest:sanctum')->group(function () {
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'index']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/tasks', App\Http\Controllers\App\TaskController::class);
});
