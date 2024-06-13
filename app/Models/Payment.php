<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function getFormattedValueAttribute() {
        return 'R$ ' . number_format($this->value, 2, ',', '.');
    }

    public function getFormattedPaymentDateAttribute() {
        return Carbon::parse($this->payment_date)->format('d/m/Y');
    }

}
