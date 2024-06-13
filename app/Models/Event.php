<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'date',
        'location',
        'organizer_id',
        'capacity',
        'price'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function registrations() {
        return $this->hasMany(Registration::class);
    }

    public function getFormattedPriceAttribute() {
        return 'R$ ' . number_format($this->price, 2, ',', '.');
    }

    public function getFormattedDateAttribute() {
        return Carbon::parse($this->date)->format('d/m/Y');
    }
}
