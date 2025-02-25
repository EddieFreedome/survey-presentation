<?php

namespace App\Livewire;

use App\Models\Adminsession;
use App\Models\Savesession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Clicker extends Component
{ 
    public function redirectUserIfAdminsession() {
        $adminsession = Adminsession::exists();
        // dd($adminsession);
        if ($adminsession) {

            $this->redirect(route('start'));
            // return view('auth.login');
        }
        
    }

    public function pollingQuestionTime() {
        $adminsession = Adminsession::first();
        $start_time = Carbon::parse($adminsession->start_time);
        $current_time = Carbon::now();
        $diffInSeconds = $current_time->diffInSeconds($start_time);
        return $diffInSeconds;
    }

    
    // public function adminStartQuiz() {
    //     //create timestamp per session start
    //     $session = new Savesession();
    //     $session->user_id = Auth::user()->id;
    //     $session->start_session = Carbon::now()->format('Y-m-d H:i:s.u');

    //     $dt1 = Carbon::now();
    //     $dt2 = Carbon::now()->addSeconds(40);

    //     $diffInSeconds = $dt2->diffInSeconds($dt1);


    
    //     if ($diffInSeconds >= 40) {
    //         echo "The difference is greater than or equal to 40 seconds.";
    //     } else {
    //         echo "The difference is less than 40 seconds.";
    //     }


    //     // $session->save();
    // }
    
    // public function adminReset(){
    // }

    // public $redirectUser;
    
    
    // check if saved adminsessionline polling?
    // public function handleClick(){
    //     // $adminsession = Adminsession::find(1);

    //     // if (!$adminsession) {
    //     //     $adminsession = new Adminsession();
    //     //     $adminsession->start_session = Carbon::now()->format('Y-m-d H:i:s.u');
    //     //     $adminsession->save();

    //     //     $redirectUser = true;
    //     // } else {
    //     //     $redirectUser = false;
    //     // }

    //     // return redirect(route('dashboard')); //change to: display button to users in lobby
    // }
   
    public function render()
    {
        return view('livewire.clicker');
    }
}
