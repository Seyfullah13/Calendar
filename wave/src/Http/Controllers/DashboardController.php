<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $now = Carbon::now();
    $thirtyDaysFromNow = Carbon::now()->addDays(30);
    // $now = Carbon::createFromFormat('d/m/Y', $d);
    // $thirtyDaysFromNow = Carbon::createFromFormat('d/m/Y', $d)->addDays(30);

    $user_properties = Auth::user()->userRoles->pluck('property.id');
    $canceled = BookingStatus::where('id', 4)->first();

    $query = Booking::whereIn('property_id', $user_properties)
      ->whereBetween('booked_at', [$now, $thirtyDaysFromNow]);

    // dd($query->get(), $now, $thirtyDaysFromNow);


    $total_booking = $query->count();
    $total_guest = $query->sum('number_of_guests');

    // --- check_in query ---
    $query = Booking::whereIn('property_id', $user_properties)
      ->whereBetween('check_in', [$now, $thirtyDaysFromNow]);
    $check_in = $query->count();
    // ----- end check_in query -----
    // --- check_out query ---
    $query = Booking::whereIn('property_id', $user_properties)
      ->whereBetween('check_out', [$now, $thirtyDaysFromNow]);
    $check_out = $query->count();


    $canceled = $query->where('booking_status_id', $canceled->id)
      ->count();

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
    return view('theme::dashboard.index', compact('total_booking', 'total_guest', 'check_in', 'check_out', 'canceled', 'months'));
  }
}