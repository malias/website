<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;

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

Route::get('/', IndexController::class);
Route::get('/category/{slug}', CategoryController::class);
Route::get('/tag/{slug}', TagController::class);
Route::get('/blog/{slug}', [BlogController::class, 'show']);
Route::get('/search', [BlogController::class, 'search']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
