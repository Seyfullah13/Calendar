<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $fillable = [
        'preparation_time', 'currency', 'check_in', 'check_out', 'number_of_nights', 'number_of_children', 'number_of_animals',
        'number_of_guests', 'number_of_adults', 'external_reservation_id', 'number_of_nights', 'external_status', 'total_fee', 'total_taxes',
        'total_payout', 'booked_at', 'token', 'currency', 'booking_guest_id'
    ];


    public function property(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function guest(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BookingGuest::class, 'id', 'booking_guest_id');
    }

    public function partenaire(): BelongsTo
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BookingStatus::class, 'id', 'booking_status_id');
    }

    public function conversation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Conversation::class, 'id', 'conversation_id');
    }


    public function checkForConflicts($propertyId, $checkIn, $checkOut, $excludeId = null)
    {
        $query = Booking::where('property_id', $propertyId)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                        ->where('check_out', '>', $checkIn);
                });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if ($booking->checkForConflicts($booking->property_id, $booking->check_in, $booking->check_out)) {
                throw new ModelNotFoundException('A booking already exists for the given date range.');
            }
        });

        static::updating(function ($booking) {
            if ($booking->checkForConflicts($booking->property_id, $booking->check_in, $booking->check_out, $booking->id)) {
                throw new ModelNotFoundException('A booking already exists for the given date range.');
            }
        });
    }
}
