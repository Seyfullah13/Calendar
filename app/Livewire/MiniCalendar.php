<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Partenaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BookingGuest;
use App\Models\BookingStatus;
use App\Models\Photo;
use App\Models\Property;
use Carbon\Carbon;

class MiniCalendar extends Component
{
  public $resources = [];
  public $events = [];
  public $borderColors = [];
  // public $countriesJson_path;

  public function mount()
  {
    // $this->countriesJson_path = asset('countryPhoneCodes.json');

    $now = Carbon::now();
    $thirtyDaysFromNow = Carbon::now()->addDays(30);
    // Fetch properties owned by the current user
    $user_properties = Auth::user()->userRoles->pluck('property')->where('is_enabled', true);
      // ->take(6)

    foreach ($user_properties as $property) {
      $this->resources[] = [
        'id' => $property->external_id,
        'title' => $property->attribute->name,
      ];
    }

    $confirmed = BookingStatus::where('name', 'Confirmé')->first();
    // Fetch bookings for these properties
    $bookings = Booking::whereIn('property_id', $user_properties->pluck('id'))
      // ->whereBetween('booked_at', [$now, $thirtyDaysFromNow])
      ->where('booking_status_id', $confirmed->id)
      ->get();
    // Format bookings into events
    foreach ($bookings as $booking) {
      // $phone_parts = explode('-', $booking->guest->phone);
      // $phone_parts = $booking->guest->phone;

      $this->events[] = [
        'id' => $booking->id,
        'resourceId' => $booking->property->external_id,
        // 'start' => Carbon::parse($booking->check_in)->format('Y-m-d'),
        // 'end' => Carbon::parse($booking->check_out)->format('Y-m-d'),
        'start' => $booking->check_in,
        'end' => $booking->check_out,
        'title' => $booking->guest->first_name . ' ' . $booking->guest->last_name, // You can keep the title as a string
        'extendedProps' => [
          // 'phone_code' => ltrim($phone_parts[0], '+'), // remove the + in begining of the code cuz in the json file the phone codes doesn't have it
          // 'phone' => $phone_parts[1],
          'phone' => $booking->guest->phone,
          'arrival' => Carbon::parse($booking->check_in)->format('D, M d, Y'),
          'departure' => Carbon::parse($booking->check_out)->format('D, M d, Y'),
          'arrivalTime' => Carbon::parse($booking->check_in)->format('H:i'),
          'departureTime' => Carbon::parse($booking->check_out)->format('H:i'),

          'prices' => $booking->total_payout,
          'nights' => $booking->number_of_nights,
          'adults'  => $booking->number_of_adults,
          'children' => $booking->number_of_children,
          'animals' => $booking->number_of_animals,
          'email' => $booking->guest->email,
          'picture' => $booking->guest->picture,
          'icon' => [
            'url' => $booking->partenaire->icon ?? null,
            'name' => $booking->partenaire->name ?? null,

          ],
        ],
      ];
    }


    // dd($this->events);
    // -----
    Partenaire::all()->each(function ($partenaire) {
      $this->borderColors[strtolower($partenaire->name)] = $partenaire->border_color;
    });
  }

  public function render()
  {
    return view('livewire.mini-calendar');
  }
}