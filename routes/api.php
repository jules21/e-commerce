<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::apiResource('accounts',\App\Http\Controllers\Api\AccountController::class);
    Route::apiResource('accounts.topups',\App\Http\Controllers\Api\TopupController::class);

    Route::get('purchases', [\App\Http\Controllers\Api\PurchaseController::class, 'index']);
    Route::get('my-purchases', [\App\Http\Controllers\Api\PurchaseController::class, 'myPurchases']);
    Route::get('products/{product}/buy', [\App\Http\Controllers\Api\PurchaseController::class, 'buy']);
});


Route::post('register', [\App\Http\Controllers\Api\AuthController::class,'register']);
Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::apiResource('products',\App\Http\Controllers\Api\ProductController::class);
