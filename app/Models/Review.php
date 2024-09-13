<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'rating', 'comment', 'booking_guest_id', 'property_id'];

    // Relation avec le modèle BookingGuest
    public function bookingGuest()
    {
        return $this->belongsTo(BookingGuest::class, 'booking_guest_id');
    }

    // Relation avec le modèle Property
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function photos()
    {
        return $this->morphToMany(Photo::class, 'photoable');
    }
}
