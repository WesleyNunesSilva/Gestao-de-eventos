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

// Login Routes
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [EventController::class, 'index']); // Redirecionar para a listagem de eventos
});

Route::middleware(['auth', 'checkType:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('registrations', RegistrationController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('events', EventController::class);
});

Route::middleware(['auth', 'checkType:admin,organizer'])->group(function () {
    Route::resource('events', EventController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/home', function () { 
        return view('home');
    });
});

Route::middleware(['auth', 'checkType:registered'])->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    //Route::resource('registrations', RegistrationController::class);
    Route::put('/registrations/{id}/update', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::post('/registrations/store/{event}', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::post('/events/{event}/registered', [EventController::class, 'registered'])->name('events.registered');
});

