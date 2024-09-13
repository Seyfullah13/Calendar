<?php

namespace App\Livewire;

use App\Models\Partenaire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use Psy\Command\HistoryCommand;
// use Livewire\Attributes\On;

class DonutChart extends Component
{
  // public $chartData;
  public $data;
  // protected $listeners = ['refreshChart' => 'refreshData'];

  // #[On('month-filter')]
  // public function updateMonth($month = "00")
  // {
  //     // $this->mount();
  //     // $this->render();
  //     // $this->chartData = $this->fetchChartData($month);
  // }
  // #[On('getUpdatedChartData')]
  // public function getUpdatedChartData()
  // {
  //     $this->chartData = $this->fetchChartData("10");
  //     $this->dispatch('updatedChartData', $this->chartData);
  // }



  // public function fetchChartData($month = "00")
  // {
  //     $user_properties = Auth::user()->userRoles->pluck('property.id');
  //     $currentYear = date('Y');

  //     $partenaires = Partenaire::whereHas('bookings', function ($query) use ($user_properties, $currentYear, $month) {
  //         $query->whereIn('property_id', $user_properties);
  //         if ($month !== "00") {
  //             $query->whereMonth('booked_at', '=', $month)
  //                 ->whereYear('booked_at', '=', $currentYear);
  //         }
  //     })
  //         ->withCount(['bookings as bookings_count' => function ($query) use ($user_properties, $currentYear, $month) {
  //             $query->whereIn('property_id', $user_properties);
  //             if ($month !== "00") {
  //                 $query->whereMonth('booked_at', '=', $month)
  //                     ->whereYear('booked_at', '=', $currentYear);
  //             }
  //         }])
  //         ->get();

  //     $this->chartData = [
  //         'series' => $partenaires->pluck('bookings_count')->toArray(),
  //         'labels' => $partenaires->pluck('name')->toArray(),
  //         'colors' => $partenaires->pluck('background_color')->toArray(),
  //     ];
  //     info("from class  : ");
  //     info($this->chartData);
  //     return $this->chartData;
  // }

  public function mount($data)
  {
    $this->data = $data;
    // dd($this->data);
  }


  public function render()
  {
    return view('livewire.donut-chart');
  }
}