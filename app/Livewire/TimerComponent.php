<?php

namespace App\Livewire;

use App\Models\Adminsession;
use Livewire\Component;

class TimerComponent extends Component
{
    public $timeRemaining = 40;
    
    protected $listeners = ['resetTimer' => 'resetTimer'];
    
    public function decrementTime()
    {
        if ($this->timeRemaining > 0) {
            $this->timeRemaining--;
        } else {
            // When timer reaches 0, dispatch event so that HiddenForm handles nextstep
            $this->dispatch('timerFinished');
            $this->resetTimer();
        }
    }
    
    public function resetTimer()
    {
        $this->timeRemaining = 40;
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
