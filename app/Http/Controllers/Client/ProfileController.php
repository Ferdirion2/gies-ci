<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $client = auth('client')->user();
        return view('client.profile', compact('client'));
    }

    public function update(Request $request)
    {
        $client = auth('client')->user();

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $client->update($data);

        return redirect()->route('client.profile.edit')->with('success', 'Profil mis à jour.');
    }

    public function showChangePassword()
    {
        $client = auth('client')->user();
        return view('client.change-password', compact('client'));
    }

    public function updatePassword(Request $request)
    {
        $client = auth('client')->user();

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($request->input('current_password'), $client->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $client->password = Hash::make($request->input('password'));
        $client->save();

        return redirect()->route('client.profile.edit')->with('success', 'Mot de passe modifié.');
    }
}
