<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeatMapChart extends Component
{
    public $init_heatmap_data;

    public function mount($data)
    {
        $this->init_heatmap_data = $data;
    }

    // public function generateHeatmapData)
    // {
    //     $property = Property::with('occupancies')->findOrFail($propertyId);
    //     $occupancies = $property->occupancies;

    //     $data = [];
    //     foreach ($occupancies as $occupancy) {
    //         $date = Carbon::parse($occupancy->date);
    //         $week = $date->format('W');
    //         $dayOfWeek = $date->format('N'); // 1 (for Monday) through 7 (for Sunday)

    //         $data[] = ['x' => "W$week", 'y' => $dayOfWeek, 'value' => 1]; // 'value' can be used for color intensity if needed
    //     }

    //     return $data;
    // }

    public function render()
    {
        // dd(Auth::user()->userRoles->pluck('property'));
        return view('livewire.heat-map-chart');
    }
}
