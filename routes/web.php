<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// middleware group
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('pages.dashboard', ['type_menu' => 'dashboard']);
    });
    Route::resource('users', App\Http\Controllers\Users::class);
    Route::resource('products', App\Http\Controllers\ProductsController::class);
});
