<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', function () {return view('home');});

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/events', [EventController::class, 'index'])->name('event.index');
Route::get('/registrations', [RegistrationController::class, 'index'])->name('registration.index');
Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
