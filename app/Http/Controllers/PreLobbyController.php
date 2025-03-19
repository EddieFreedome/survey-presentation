<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PreLobbyController extends Controller
{
    public function show(Request $request)
    {
        $user = User::find($request->user);
        $name = $user->name;
        if (!$user) {
            return redirect()->route('sign-in')->with('error', 'Utente non trovato.');
        }
        // dd($name);
        // Recuperiamo il nome dalla sessione
        return view('dashboard', compact('name'));
    }
}
