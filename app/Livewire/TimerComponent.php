<?php

namespace App\Livewire;

use App\Models\Adminsession;
use Livewire\Component;

class TimerComponent extends Component
{
    public $timeRemaining = 40;
    
    public function decrementTime()
    {
        
        if ($this->timeRemaining > 0) {
            $this->timeRemaining--;
            // $this->emit('timeChanged', $this->timeRemaining);
        } else {
            // $this->emit('timerEnded');
        }
    }

    // public function mount()
    // {
    //     $this->timeRemaining = Adminsession::first()->start_time;
    // }
    
    public function render()
    {
        return view('livewire.timer-component');
    }
}
