<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'date',
        'location',
        'organizer',
        'capacity',
        'price'
    ];

    public function registrations() {
        return $this->hasMany(Registration::class);
    }
}
