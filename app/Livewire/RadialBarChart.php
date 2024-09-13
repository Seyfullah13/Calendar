<?php

namespace App\Livewire;

use Livewire\Component;
// use Livewire\Attributes\On;

class RadialBarChart extends Component
{
    public $occupation;

    // #[On('month-filter')]
    // public function monthFilter($month)
    // {
    //     $data = $this->calculateOccupation($month);
    //     $this->dispatch('radial-update', $data)->self();
    // }

    public function mount($data)
    {
        $this->occupation =  $data;
    }

    public function render()
    {
        return view('livewire.radial-bar-chart');
    }
}