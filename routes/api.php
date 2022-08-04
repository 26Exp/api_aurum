<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\VendorController;
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
        Route::get('/user', [AuthController::class,'user']);
        Route::post('/logout', [AuthController::class,'logout']);

        Route::resource('/attributes', AttributeController::class);
        Route::get('/attributes/{attribute}/values', [AttributeValueController::class,'getAttributeValues']);
        Route::resource('/attribute-values', AttributeValueController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/manufacturers', ManufacturerController::class);


    });

//    Route::get('1C/sync', [ProductController::class,'sync']);
});
