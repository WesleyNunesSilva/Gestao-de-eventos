<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'registration_date',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function hasPayment() {
        return $this->payment()->exists();
    } 

    public function hasPaymentForEvent($eventId) {
        return $this->payment()->whereHas('registration', function ($query) use ($eventId) {
            $query->where('event_id', $eventId);
        })->exists();
    }

    public function getFormattedRegistrationDateAttribute() {
        return Carbon::parse($this->registration_date)->format('d/m/Y');
    }
    public function getFormattedEventDateAttribute() {
        return Carbon::parse($this->event->date )->format('d/m/Y');
    }

    public function canConfirm($user) {
        return $this->status == 'pending' && $user->type !== 'registered';
    }

    public function canCancel($user) {
        return $user->type !== 'registered' || $user->id === $this->organizer_id;
    }

    public function canPay($user) {
        return $this->status == 'pending' && !$this->payment && $user->type == 'registered';
    }
}
