<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ClientPasswordResetCode;
use App\Models\Client;
use App\Models\ClientPasswordResetCode as ResetCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function create()
    {
        return view('client.auth.forgot-password');
    }

    public function sendCode(Request $request)
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        $client = Client::where('email', $data['email'])->first();

        if ($client) {
            $code = (string) random_int(100000, 999999);
            ResetCode::where('email', $client->email)->delete();
            $reset = ResetCode::create([
                'email' => $client->email,
                'code_hash' => Hash::make($code),
                'expires_at' => now()->addMinutes(10),
            ]);
            Mail::to($client->email)->send(new ClientPasswordResetCode($code));
            $request->session()->put('client_password_reset_id', $reset->id);
        }

        return redirect()->route('client.password.verify')->with('status', 'Si cette adresse correspond à un compte, un code de vérification a été envoyé.');
    }

    public function verify()
    {
        return view('client.auth.verify-reset-code');
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => ['required', 'digits:6']]);
        $reset = ResetCode::find($request->session()->get('client_password_reset_id'));

        if (! $reset || $reset->expires_at->isPast() || $reset->attempts >= 5 || ! Hash::check($request->code, $reset->code_hash)) {
            if ($reset && $reset->attempts < 5) {
                $reset->increment('attempts');
            }
            return back()->withErrors(['code' => 'Code invalide ou expiré.']);
        }

        $reset->update(['verified_at' => now()]);
        return redirect()->route('client.password.reset');
    }

    public function reset()
    {
        $reset = ResetCode::find(session('client_password_reset_id'));
        if (! $reset || ! $reset->verified_at || $reset->expires_at->isPast()) {
            return redirect()->route('client.password.forgot');
        }
        return view('client.auth.reset-password');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $reset = ResetCode::find($request->session()->get('client_password_reset_id'));

        if (! $reset || ! $reset->verified_at || $reset->expires_at->isPast()) {
            return redirect()->route('client.password.forgot')->withErrors(['email' => 'La demande de réinitialisation est invalide ou expirée.']);
        }

        Client::where('email', $reset->email)->update(['password' => Hash::make($data['password'])]);
        $reset->delete();
        $request->session()->forget('client_password_reset_id');

        return redirect()->route('client.login')->with('status', 'Votre mot de passe a été réinitialisé.');
    }
}