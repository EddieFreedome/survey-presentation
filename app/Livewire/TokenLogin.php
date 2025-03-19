<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class TokenLogin extends Component
{
    public $name;

    public function mount() {
        $loginToken = Cookie::get('login_token');

        if ($loginToken) {
            // Controlla se esiste un utente con questo token
            $user = User::where('login_token', $loginToken)->first();

            if ($user) {
                // Se l'utente esiste, reindirizzalo alla pre-lobby
                return redirect()->route('pre-lobby');
            }
        }
    }

    public function render()
    {
        return view('livewire.token-login');
    }

    public function submit() {
        $this->validate([
            'name' => 'required|string|unique:users,name|max:50'
        ]);

        // Crea un nuovo utente con un token univoco

        $user = new User();
        $user->name = $this->name;
        $user->login_token = Str::random(32);
        $user->save();

        Cookie::queue('login_token', $user->login_token, 60 * 2);
    // Salva il nome come cookie persistente
        Cookie::queue('name', $this->name, 60 * 2);

        // Verifica se i cookie sono stati impostati
        // dd(Cookie::get('name'), Cookie::get('login_token'));


        // Reindirizza alla pre-lobby
        return redirect()->route('pre-lobby', ['user' => $user]);  
    }
    
}
