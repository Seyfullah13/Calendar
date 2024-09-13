<?php

namespace App\Livewire;

use App\Models\Booking;
use Carbon\Carbon;
use Livewire\Component;

class MonthPicker extends Component
{
  public $months;
  public $years = [];
  public $currentMonth;
  public $currentYear;
  public $properties_types;

  public function mount($months, $properties_types)
  {
    $this->months = $months;
    $this->properties_types =  $properties_types;
    $this->currentMonth = Carbon::now()->format('m');
    $this->currentYear = Carbon::now()->format('Y');

    // Query the earliest and latest booking years
    $earliestYear = Carbon::parse(Booking::min('booked_at'))->format('Y');
    $latestYear = Carbon::parse(Booking::max('booked_at'))->format('Y');

    // Create the range of years
    $this->years = range($earliestYear, $latestYear);
    // dd($this->years);
  }


  public function filter_dispache($start, $end, $property_type)
  {
    $this->dispatch('filter-trigger', $start, $end, $property_type);
    // $this->dispatch('filter', $start, $end, $property_type)->to(StatisticsPage::class);
  }

  public function render()
  {
    return view('livewire.month-picker');
  }
}