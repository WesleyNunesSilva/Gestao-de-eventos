<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LoginController;


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

Route::get('/', function () { 
    return view('home');
});

Route::get('/home', [EventController::class, 'index']);

Route::resource('users', UserController::class,);
Route::resource('events', EventController::class,);
Route::resource('registrations', RegistrationController::class,);
Route::resource('payments', PaymentController::class,);

// Login Routes

Auth::routes();


