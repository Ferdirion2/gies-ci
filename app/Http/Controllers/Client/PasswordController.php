<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('client.password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'mot_de_passe_actuel' => 'required',
            'nouveau_mot_de_passe' => 'required|min:8|confirmed',
        ]);

        $client = auth('client')->user();

        if (!Hash::check($request->mot_de_passe_actuel, $client->password)) {
            return back()->withErrors(['mot_de_passe_actuel' => 'Mot de passe actuel incorrect.']);
        }

        $client->update(['password' => Hash::make($request->nouveau_mot_de_passe)]);

        return redirect()->route('client.dashboard')->with('success', 'Votre mot de passe a été mis à jour.');
    }
}