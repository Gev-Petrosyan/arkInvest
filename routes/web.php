<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\KeysController;
use App\Http\Controllers\parseController;
use App\Http\Controllers\TextController;
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

Route::get('/', [HomeController::class, 'welcome']);
Route::get('/register', [HomeController::class, 'register']);
Route::get('/forgot-password', [HomeController::class, 'forgotPassword']);

Route::group(['prefix' => 'parse'], function(){
    Route::get('get', [parseController::class, 'get'])->name('parse.get');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'key'], function(){
        Route::post('store', [KeysController::class, 'store'])->name('key.store');
        Route::get('delete/{id}', [KeysController::class, 'delete'])->name('key.delete');
        Route::post('update', [KeysController::class, 'update'])->name('key.update');
    });

    Route::group(['prefix' => 'image'], function(){
        Route::post('update', [ImageController::class, 'update'])->name('image.update');
    });

    Route::group(['prefix' => 'text'], function(){
        Route::post('update', [TextController::class, 'update'])->name('text.update');
    });

    Route::group(['prefix' => 'color'], function(){
        Route::post('update', [ColorController::class, 'update'])->name('color.update');
    });
});
