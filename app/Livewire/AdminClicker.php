<?php

namespace App\Livewire;

use App\Models\Adminsession;
use App\Models\Savesession;
use App\Models\Savesessionline;
use Carbon\Carbon;
use Livewire\Component;

class AdminClicker extends Component
{
    // public function pollingSession(){
        
    // }
    public function startQuiz(){
        // dd('start');
        $adminsession = Adminsession::exists();
        $start_time = Carbon::now();

        if (!$adminsession) {
            $adminsession = new Adminsession();
            $adminsession->start_time = $start_time->format('Y-m-d H:i:s');
            $adminsession->save();
        }
    }
    public function resetQuiz(){
        $adminsession = Adminsession::exists();
        $savesessionlines = Savesessionline::exists();
        $savesessions = Savesession::exists();


        if ($adminsession) {
            $adminsession = Adminsession::all();
            foreach ($adminsession as $session) {
                $session->delete();
            }
        }

        if ($savesessionlines) {
            $savesessionlines = Savesessionline::all();
            foreach ($savesessionlines as $session) {
                $session->delete();
            }
        }

        if ($savesessions) {
            $savesessions = Savesession::all();
            foreach ($savesessions as $session) {
                $session->delete();
            }
        }


    }
    public function render()
    {
        return view('livewire.admin-clicker');
    }
}
