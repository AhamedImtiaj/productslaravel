<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;



Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
// Route::group(['middleware'=>'auth'],function(){
//     Route::resource('products', ProductController::class);
// });
Route::group(['middleware'=>'auth'],function () {

    Route::resource('products', ProductController::class);
    });

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



