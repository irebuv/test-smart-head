<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'user.login')->middleware('guest')->name('login');
Route::post('/login', LoginController::class)->middleware('guest')->name('login.store');
Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

Route::get('/widget', [WidgetController::class, 'index'])->name('widget');

Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    // Tickets routes
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
    Route::get('/tickets/show/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/status/{ticket}', [TicketController::class, 'status'])->name('tickets.status');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/users', [UserController::class, 'index'])->name('users');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Tickets routes
    Route::delete('/tickets/destroy/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});
