<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function addBookings()
    {
        return view('themes.tailwind.booking.add-bookings');
    }

    public function edit($id)
    {
        $booking = Booking::find($id);
        
        return view('themes.tailwind.booking.edit-booking', compact('booking')); //resources/views/properties/edit.blade.php
    }
}
