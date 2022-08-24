<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('dd', 'deb');
});

Route::prefix('tasks')->middleware('auth:api')->controller(TasksController::class)->group(function () {

    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('create', 'create');
    Route::post('update/{id}', 'update');
    Route::get('delete/{id}', 'delete');
    Route::post('dd', 'deb');
});


Route::prefix('user')->middleware('auth:api')->controller(UserController::class)->group(function () {

    Route::get('/', 'show');
    Route::post('/update', 'update');
    Route::get('delete/', 'delete');

});