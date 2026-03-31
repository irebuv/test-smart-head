<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/login', 'user.login')->middleware('guest')->name('login');
Route::post('/login', LoginController::class)->middleware('guest')->name('login.store');

Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
});
