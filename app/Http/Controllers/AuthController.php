<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $token = $request->query('token');
        session()->flash('message', 'messages.auth.token.error');

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                $user = $accessToken->tokenable;

                Auth::login($user);

                return redirect()->route('filament.front.pages.dashboard');
            }
        }

        session()->flash('error', 'messages.auth.token.error');

        return redirect()->route('login');
    }
}
