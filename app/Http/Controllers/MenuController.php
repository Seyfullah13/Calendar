<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingStatus;
use App\Filament\Resources\PropertyResource\Pages\ListProperties;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function booking()
    {
        return view('themes.tailwind.booking.booking');
    }

    public function messages()
    {
        return view('themes.tailwind.messages.message');
    }

    public function calendar()
    {
        return view('themes.tailwind.calendar.calendar');
    }


    public function statistics(Request $request)
    {
        $months = [
            (object) ['name' => 'January', 'value' => '01'],
            (object) ['name' => 'February', 'value' => '02'],
            (object) ['name' => 'March', 'value' => '03'],
            (object) ['name' => 'April', 'value' => '04'],
            (object) ['name' => 'May', 'value' => '05'],
            (object) ['name' => 'June', 'value' => '06'],
            (object) ['name' => 'July', 'value' => '07'],
            (object) ['name' => 'August', 'value' => '08'],
            (object) ['name' => 'September', 'value' => '09'],
            (object) ['name' => 'October', 'value' => '10'],
            (object) ['name' => 'November', 'value' => '11'],
            (object) ['name' => 'December', 'value' => '12'],
        ];
        $properties_types = PropertyType::all();
        // * Total booking

        // * Total quest 
        // * Check in 
        /*
            '01' for January
            '02' for February
            '03' for March
            '04' for April
            '05' for May
            '06' for June
            '07' for July
            '08' for August
            '09' for September
            '10' for October
            '11' for November
            '12' for December
        */



        // * Check out

        // * Canceled
        // Get the canceled booking status

        // Calculate the number of canceled bookings for the user's properties


        return view('themes.tailwind.statistics.statistics', compact('months', 'properties_types'));
    }


    public function propertyCalendar()
    {
        return view('themes.tailwind.calendar.property-calendar');
    }

    public function properties()
    {

        return view('themes.tailwind.properties.properties');
    }

    public function propertyAttributes()
    {

        return view('themes.tailwind.properties.property-attributes');
    }

    public function propertyAddresses()
    {

        return view('themes.tailwind.properties.property-addresses');
    }

    public function account()
    {
        return view('themes.tailwind.account.account');
    }
}
