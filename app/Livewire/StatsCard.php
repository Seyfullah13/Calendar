<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\BookingStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;

use function Illuminate\Events\queueable;

class StatsCard extends Component
{
  public $statistic = 0;
  public $start_stat = 0;
  public $end_stat = 0;
  public string $title;
  public string $icon;
  public $stat_type;
  public $change = 0;


  #[On('filter-trigger')]
  public function updateStats($start = 0, $end = 0, $property_type = 0)
  {
    $startDate = Carbon::parse($start);
    $endDate = Carbon::parse($end)->endOfDay();

    // dd($startDate, $endDate);
    info($startDate);
    info($endDate);
    info("----------------------------------------------------------");

    $user_properties = Auth::user()->userRoles->pluck('property.id');
    // dd($user_properties[0]->attribute->type);
    $canceled = BookingStatus::where('id', 4)->first();

    // Base query 
    $query = Booking::whereIn('property_id', $user_properties)
      ->whereBetween('booked_at', [$startDate, $endDate]);

    // dd($query->get());

    // Start and end month queries
    $start_month_query = (clone $query)
      ->whereYear('booked_at', $startDate->year)
      ->whereMonth('booked_at', $startDate->month);

    $end_month_query = (clone $query)
      ->whereYear('booked_at', $endDate->year)
      ->whereMonth('booked_at', $endDate->month);

    // Property type filtering (if provided)
    if ($property_type != 0) {
      $query->whereHas('property.attribute', function ($q) use ($property_type) {
        // dd($property_type, $q);
        $q->where('property_type_id', '=', $property_type);
      });
      $start_month_query->whereHas('property.attribute', function ($q) use ($property_type) {
        $q->where('property_type_id', '=', $property_type);
      });
      $end_month_query->whereHas('property.attribute', function ($q) use ($property_type) {
        $q->where('property_type_id', '=', $property_type);
      });
    }

    // Calculate stats based on the type
    switch ($this->stat_type) {
      case 'total_booking':
        $this->statistic = $query->count();
        // dd($this->statistic);
        break;

      case 'total_guest':
        $this->statistic = $query->sum('number_of_guests');
        break;

      case 'check_in':
        $this->statistic = $query->whereBetween('check_in', [$startDate, $endDate])->count();
        $start_month_query->whereYear('check_in', $startDate->year)->whereMonth('check_in', $startDate->month);
        $end_month_query->whereYear('check_in', $endDate->year)->whereMonth('check_in', $endDate->month);
        break;

      case 'check_out':
        $this->statistic = $query->whereBetween('check_out', [$startDate, $endDate])->count();
        $start_month_query->whereYear('check_out', $startDate->year)->whereMonth('check_out', $startDate->month);
        $end_month_query->whereYear('check_out', $endDate->year)->whereMonth('check_out', $endDate->month);
        break;

      case 'canceled':
        $this->statistic = $query->where('booking_status_id', $canceled->id)->count();
        $start_month_query->where('booking_status_id', $canceled->id);
        $end_month_query->where('booking_status_id', $canceled->id);
        break;
    }

    // Calculate change percentage
    $this->start_stat = $start_month_query->count();
    $this->end_stat = $end_month_query->count();

    if ($this->start_stat != 0) {
      $this->change = round((($this->end_stat - $this->start_stat) / $this->start_stat) * 100, 2);
    } else {
      $this->change = $this->end_stat > 0 ? 100 : 0;
    }
  }

  public function mount($title, $icon, $stat_type)
  {
    $this->title = $title;
    $this->icon = $icon;
    $this->stat_type = $stat_type;

    // Initial stats
    $start = Carbon::now()->startOfMonth()->format('Y-m-d');
    // Get the date 30 days from now
    // $end = $start->addDays(30)->format('Y-m-d');
    $end = Carbon::now()->endOfMonth()->format('Y-m-d');
    // dd($start, $end);
    $this->updateStats($start, $end);
  }

  public function render()
  {
    return view('livewire.stats-card');
  }
}