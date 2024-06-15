<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Auth::routes();

// Rotas acessíveis a todos os usuários autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('payment.index');
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
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    
    Route::get('events/{eventId}/payments', [EventController::class, 'showEventPayments'])->name('events.payments');
    Route::resource('events', EventController::class)->except(['show']);
});

Route::middleware(['auth', 'checkType:registered,admin,organizer'])->group(function () {
    Route::post('/registrations/store/{event}', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::put('/registrations/{id}/update', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    
    Route::post('/payments/store/{id}', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/create/{id}', [PaymentController::class, 'create'])->name('payments.create');
    Route::put('/payments/{id}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/organizer/financial-report', [PaymentController::class, 'financialReport'])->name('payments.financial');

    Route::post('/events/{event}/registered', [EventController::class, 'registered'])->name('events.registered');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('events', [EventController::class, 'index'])->name('events.index');

});
