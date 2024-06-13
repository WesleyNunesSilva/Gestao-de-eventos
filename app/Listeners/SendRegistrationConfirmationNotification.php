<?php

namespace App\Listeners;

use App\Events\RegistrationConfirmed;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmedMail;

class SendRegistrationConfirmationNotification
{
    public function handle(RegistrationConfirmed $event)
    {
        Mail::to($event->registration->user->email)
            ->send(new RegistrationConfirmedMail($event->registration));
    }
}
