<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Partenaire;
use App\Models\Property;
use App\Models\PropertyType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

use function Pest\Laravel\get;

class StatisticsPage extends Component
{
  public $months;
  public $properties_types;
  public $donutChart = [];
  public $radialChart = [];
  public $heatmap = [];

  public function mount()
  {
    $this->months = [
      (object) ['name' => 'January', 'value' => '01', 'days' => 31],
      (object) ['name' => 'February', 'value' => '02', 'days' => 28], // Note: February can have 29 days in a leap year
      (object) ['name' => 'March', 'value' => '03', 'days' => 31],
      (object) ['name' => 'April', 'value' => '04', 'days' => 30],
      (object) ['name' => 'May', 'value' => '05', 'days' => 31],
      (object) ['name' => 'June', 'value' => '06', 'days' => 30],
      (object) ['name' => 'July', 'value' => '07', 'days' => 31],
      (object) ['name' => 'August', 'value' => '08', 'days' => 31],
      (object) ['name' => 'September', 'value' => '09', 'days' => 30],
      (object) ['name' => 'October', 'value' => '10', 'days' => 31],
      (object) ['name' => 'November', 'value' => '11', 'days' => 30],
      (object) ['name' => 'December', 'value' => '12', 'days' => 31],
    ];

    $this->properties_types = PropertyType::all();

    $start = Carbon::now()->startOfMonth()->format('Y-m-d');
    $end = Carbon::now()->endOfMonth()->format('Y-m-d');

    $this->donutChart = $this->getDonutChartData($start, $end);
    $this->radialChart = $this->calculateOccupation($start, $end);
    $this->heatmap = $this->getHeatMapData();
    // $this->updateChartData();
  }

  #[On('filter-trigger')]
  public function filter($start, $end, $property_type_id)
  {
    // dd($start, $end, $property_type_id);
    $this->donutChart = $this->getDonutChartData($start, $end, $property_type_id);
    $this->radialChart = $this->calculateOccupation($start, $end, $property_type_id);

    // $this->dispatch('month-filter', $start, $property_type_id)->to(StatsCard::class);
    $this->dispatch('donut-update', $this->donutChart)->to(DonutChart::class);
    $this->dispatch('radial-update', $this->radialChart)->to(RadialBarChart::class);
  }

  public function getDonutChartData($start, $end, int $type_id = 0)
  {
    $startDate = Carbon::parse($start)->startOfMonth();
    $endDate = Carbon::parse($end)->endOfDay();
    // dd($start, $end, $startDate, $endDate);
    // Get the properties as  sociated with the authenticated user
    $user_properties = Auth::user()->userRoles->pluck('property.id');
    // dd($user_properties);

    $applyBookingFilters = function ($query) use ($user_properties, $startDate, $endDate, $type_id) {
      // Filter bookings by user properties
      $query->whereIn('property_id', $user_properties)
        ->whereBetween('booked_at', [$startDate, $endDate]);
      // dd($query);

      // Filter by property type if specified
      if ($type_id !== 0) {
        $query->whereHas('property.attribute', function ($query) use ($type_id) {
          $query->where('property_type_id', $type_id);
        });
      }
    };


    // dd($applyBookingFilters);
    // Query to get partenaires with bookings count
    $partenaires = Partenaire::whereHas('bookings', $applyBookingFilters)
      ->withCount(['bookings as bookings_count' => $applyBookingFilters])
      ->get();


    // Prepare data for the donut chart
    $this->donutChart = [
      'series' => $partenaires->pluck('bookings_count')->toArray(),
      'labels' => $partenaires->pluck('name')->toArray(),
      'colors' => $partenaires->pluck('background_color')->toArray(),
    ];

    return $this->donutChart;
  }

  public function calculateOccupation($start, $end, int $type_id = 0): float
  {
    // dd($start, $end, $type_id);
    $startDate = Carbon::parse($start)->startOfMonth();
    $endDate = Carbon::parse($end)->endOfDay();

    $user_properties = Auth::user()->userRoles->pluck('property.id');

    // Calculate the number of occupied properties limited by the month and current year
    $occupied_properties = Booking::whereIn('property_id', $user_properties)
      ->whereBetween('booked_at', [$startDate, $endDate]);

    // property type filter 
    // Calculate the total number of properties
    $total_properties = Property::whereIn('id', $user_properties);
    if ($type_id !== 0) {
      // dd(Property::whereIn('id', $user_properties)->get());
      // $total_properties = Property::whereIn('id', $user_properties)->where('type_id', $type_id);
      $total_properties = $total_properties
        ->whereHas('attribute', function ($query) use ($type_id) {
          $query->where('property_type_id', $type_id);
        })
        ->get();
      // ----------
      // Fetch occupied properties with the specified type_id
      $occupied_properties = $occupied_properties->whereHas('property', function ($query) use ($type_id) {
        $query->whereHas('attribute', function ($query) use ($type_id) {
          $query->where('property_type_id', $type_id);
        });
      });
    }
    // dd($total_properties->get(), $occupied_properties->get());
    $total_properties = $total_properties->count();
    $occupied_properties = $occupied_properties->distinct('property_id')->count('property_id');

    // dd($total_properties, $occupied_properties);
    // Calculate the occupation percentage
    return $total_properties > 0 ? number_format((($occupied_properties / $total_properties) * 100), 1) : 0;
  }

  public function getHeatMapData()
  {
    // Get the current user's properties
    $user_properties = Auth::user()->userRoles->pluck('property.id');
    $dailyBookingData = [];
    $currentDate = Carbon::now();

    // Initialize the dailyBookingData array with empty arrays for each day of the week
    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    foreach ($daysOfWeek as $day) {
      $dailyBookingData[$day] = [];
    }

    // Loop through the past 52++++++++++++++++++++++++++++++++++++++++++++++ weeks
    for ($i = 0; $i < 52; $i++) {
      // Loop through each day of the week
      foreach ($daysOfWeek as $day) {
        // Get the current day of the week  : startOfWeek -> Monday
        $currentDay = $currentDate->copy()->startOfWeek()->modify($day);

        // Query bookings for the current day
        $query = Booking::whereIn('property_id', $user_properties)
          ->whereDate('booked_at', $currentDay);

        // Get the bookings for the current day
        $bookings = $query->count();

        // Add the booking count to the daily data array
        $dailyBookingData[$day][] = [
          'x' => 'W' . ($i + 1),
          'y' => $bookings
        ];
      }

      // Move to the previous week
      $currentDate->subWeek();
    }

    // dd($dailyBookingData);

    // Return the booking data for the heat map
    return $dailyBookingData;
  }
  public function render()
  {
    return view('livewire.statistics-page');
  }
}






 // private function updateChartData($start, $selectedProperty = 0)
  // {
  //   $this->donutChart = $this->getDonutChartData($selectedMonth, $selectedProperty);
  //   $this->radialChart = $this->calculateOccupation($selectedMonth, $selectedProperty);
  //   // dd($this->donutChart);
  //   // $this->radialBarChart = $this->calculateRadialBarChartData($selectedMonth);
  //   // $this->heatMapChart = $this->calculateHeatMapChartData($selectedMonth);
  // }