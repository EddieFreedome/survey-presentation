<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Savesession;

class Leaderboard extends Component
{
    public $leaderboardData;
    
    public function render()
    {
        $this->leaderboardData = Savesession::with('user')
                                    ->orderBy('tot_points', 'desc')
                                    ->orderBy('created_at', 'asc')
                                    ->get();
                                    
        return view('livewire.leaderboard', [
            'leaderboardData' => $this->leaderboardData
        ]);
    }
}