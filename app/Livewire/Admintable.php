<?php

namespace App\Livewire;

use App\Models\Savesession;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class Admintable extends Component
{
    
    public $results;



    public function getResults() {

        // $mapUserSessions = Savesession::
        // $lastsession = Savesession::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        
        // $user = Savesession::where('user_id', $lastsession->user_id)->pluck('name')->first();
        
        // $result = (object)[
        //     'username' => $user->name,
        //     'tot_time_answering' => Carbon::parse($lastsession->tot_time_answering)->format('H:i:s.u'),
        //     'points' => $lastsession->tot_points,
        // ];
        // dd($result);

        $users = Savesession::all();
        $result = [];
        

        foreach ($users as $user) {
            $totTimeAnswers = Carbon::parse($user->tot_time_answering)->format('H:i:s.u');
            $totTimeAnswers = substr($totTimeAnswers, 0, -3);
    
            $result[]= [
                'username' => User::find($user->user_id)->name,
                'tot_time_answering' => $totTimeAnswers,
                'points' => $user->tot_points,
            ];
        }

        // dd($result);
        return $result;
    }
    
    public function mount() {
        $this->results = $this->getResults();
    }


    public function render()
    {
        $session = Savesession::all();
        // dd($this->getResults());

        return view('livewire.admintable',[
            'results' => $this->getResults(),
            'session' => $session
        ]);
    }
}
