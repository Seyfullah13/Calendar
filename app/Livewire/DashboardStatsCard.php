<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardStatsCard extends Component
{
  public $statistic = 0;
  public string $title;
  public string $icon;
  // public $stat_type;

  public function mount($title, $icon, $statistic)
  {
    $this->title = $title;
    $this->icon = $icon;
    // $this->stat_type = $stat_type;
    $this->statistic = $statistic;
  }


  public function render()
  {
    return view('livewire.dashboard-stats-card');
  }
}
