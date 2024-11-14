<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(Request $request, $provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id
        ],[
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'provider_token' => $socialUser->token,
            'provider' => $provider,
            'role' => 'user'
        ]);

        Auth::login($user);

        return to_route('user.dashboard');
    }
}
