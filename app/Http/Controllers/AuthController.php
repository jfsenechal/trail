<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $token = $request->query('token');
        session()->flash('message', 'Post successfully updated.');
        dd($token);
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                $user = $accessToken->tokenable;
                dd($token);
                Auth::login($user);

                return redirect()->route('/front');
            }
        }

        session()->flash('error', 'messages.auth.token.error');
        dd($token);

        return redirect()->route('/');
    }
}
