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
        dd(Session::all());
        return redirect()->view('dashboard');
    }

    public function submit() {
        $user = new User();
        $user->name = $this->name;
        $user->token = Str::random(32);
        $user->save();

        // Session::put('token', $user->token);
        // Session::put('name', $user->name);

        return redirect()->route('pre-lobby');
    }
}
