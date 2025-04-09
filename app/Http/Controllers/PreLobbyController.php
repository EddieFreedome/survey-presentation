<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class PreLobbyController extends Controller
{
    public function loginView() {
        $loginToken = Cookie::get('login_token');

        if ($loginToken) {
            // Controlla se esiste un utente con questo token
            $user = User::where('login_token', $loginToken)->first();

            if ($user) {
                // Se l'utente esiste, reindirizzalo alla pre-lobby
                return redirect()->route('pre-lobby');
            }
        }
        return view('auth.login');        
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);
        // Crea un nuovo utente con un token univoco
        
        $user = new User();
        $user->name = $request->name;
        $user->login_token = Str::random(32);
        $user->ip_user = request()->ip();
        $user->save();
        
        Cookie::queue('login_token', $user->login_token, 60 * 2);
        // Salva il nome come cookie persistente
        Cookie::queue('name', $request->name, 60 * 2);
        
        // Verifica se i cookie sono stati impostati
        // dd(Cookie::get('name'), Cookie::get('login_token'));
        
        
        // Reindirizza alla pre-lobby
        return redirect()->route('pre-lobby', ['userId' => $user->id]);  
    }
    
    
    public function show(Request $request)
    {
        //dall'oggetto $user da logintoken mi arriva solo l'id (il primo valore). Andrebbe corretto ma per il momento uso questo
        $user = User::find($request->userId);
        $userId = $user->id;

        $name = $user->name;
        if (!$user) {
            return redirect()->route('sign-in')->with('error', 'Utente non trovato.');
        }

        return view('dashboard', compact('name', 'userId'));
    }
}
