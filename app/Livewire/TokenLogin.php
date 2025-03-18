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
            // dd('no-token');
            // Se il token di sessione non è presente, reindirizza l'utente alla pagina di login
            return view('livewire.token-login');
        }
        dd('stop');
        // Se il token di sessione è presente, continua con la richiesta
        return redirect()->route('dashboard');
        
        // return view('livewire.token-login');
    }

    public function submit() {
        $user = new User();
        $user->name = $this->name;
        $user->token = Str::random(32);
        $user->save();

        Session::put('token', $user->token);

        return redirect()->route('dashboard');
    }
}
