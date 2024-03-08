<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'payment_method',
        'status',
        'payment_date',
        'registration_id',
    ];

    public function registrations() {
        return $this->belongsTo(Registration::class);
    }
}
