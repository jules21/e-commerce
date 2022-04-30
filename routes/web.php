<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\FrontPageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function (){
    Route::resource('/products', \App\Http\Controllers\ProductController::class);
});

Route::prefix('client')->middleware('auth')->group(function (){
    Route::get('products/{product}/buy', [\App\Http\Controllers\FrontPageController::class, 'buy'])->name('products.buy');
    Route::get('topups', [\App\Http\Controllers\TopupController::class, 'topups'])->name('client.topups');
    Route::get('topups/form', [\App\Http\Controllers\TopupController::class, 'create'])->name('client.topups.from');
    Route::post('topups', [\App\Http\Controllers\TopupController::class, 'store'])->name('client.topups.save');

    Route::get('purchases', [\App\Http\Controllers\TransactionController::class, 'index']);
});

