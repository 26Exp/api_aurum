<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariationController;
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


// Guest routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login'])->name('login');
});


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('/user', [AuthController::class,'user']);
        Route::post('/logout', [AuthController::class,'logout']);
    });

    Route::prefix('admin')->group(function () {
        Route::resource('/images', ImagesController::class);
        Route::get('/user', [AuthController::class,'user']);
        Route::post('/logout', [AuthController::class,'logout']);

        Route::resource('/categories', CategoryController::class);
        Route::get('/options/category/{category}', [OptionController::class,'byCategory']);
        Route::resource('/options', OptionController::class);
        Route::resource('/variations', ProductVariationController::class);
    });

    Route::get('1C/sync', [ProductController::class,'sync']);
});
