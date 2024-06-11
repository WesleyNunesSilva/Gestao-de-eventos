<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Auth::routes();

// Rotas acessíveis a todos os usuários autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('home');
});

// Rotas exclusivas para administradores
Route::middleware(['auth', 'checkType:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('registrations', RegistrationController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('events', EventController::class)->except(['index', 'show']);
});

// Rotas para administradores e organizadores
Route::middleware(['auth', 'checkType:admin,organizer'])->group(function () {
    Route::resource('events', EventController::class)->except(['show']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/home', function () { 
        return view('home');
    });
    Route::put('/registrations/{id}/update', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
});

Route::middleware(['auth', 'checkType:registered,admin,organizer'])->group(function () {
    Route::post('/registrations/store/{event}', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::put('/registrations/{id}/update', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    
    Route::post('/payments/store/{id}', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/create/{id}', [PaymentController::class, 'create'])->name('payments.create');
    Route::put('/payments/{id}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/events/{event}/registered', [EventController::class, 'registered'])->name('events.registered');
});

// Rotas de pagamentos (aplicável a todos os usuários autenticados)
Route::middleware(['auth'])->group(function () {
    Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');
    Route::get('/payments/history', [PaymentController::class, 'history'])->name('payments.history');
});