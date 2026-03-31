<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/login', 'user.login')->middleware('guest')->name('login');
Route::post('/login', LoginController::class)->middleware('guest')->name('login.store');

Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');
