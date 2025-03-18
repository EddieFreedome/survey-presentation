<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class TokenLogin extends Component
{
    public $name;
    public $token;


    public function render()
    {
        if (!Session::has('token')) {
            return view('livewire.token-login');
        }
        return redirect()->route('pre-lobby')->with('name', $this->name);
    }

    public function submit() {
        $user = new User();
        $user->name = $this->name;
        $user->token = Str::random(32);
        $user->save();

        Session::put('token', $user->token);

        return redirect()->route('pre-lobby');
    }
}
