<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();

    }

    public function handleProviderCallback($provider){

            // $user = Socialite::driver('google')->stateless()->user();
            $socialiteUser = Socialite::driver($provider)->stateless()->user();
            $existingUser = User::where('email', $socialiteUser->email)->first();

            // dd($socialiteUser);
            $user = User::updateOrCreate(
                [
                    'email' => $socialiteUser->getEmail(),
                ],
                [
                    'name' => $socialiteUser->getName() ?? $socialiteUser->getNickname(),
                    'provider' => $provider,
                    'provider_id' => $socialiteUser->getId(),
                    'avatar' => $socialiteUser->getAvatar(),
                ]
            );

            Auth::login($user);

            return redirect('/dashboard');


    }
}
