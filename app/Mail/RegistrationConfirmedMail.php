<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;

class RegistrationConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Registration $registration;

    /**
     * Create a new message instance.
     */
    public function __construct(Registration $registration) {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->subject('Confirmação de Pagamento')
                    ->view('emails.registration_confirmed') ->with([
                        'registration' => $this->registration,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Confirmed Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.registration_confirmed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
