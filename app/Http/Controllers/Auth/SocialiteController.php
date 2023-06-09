<?php
namespace App\Http\Controllers\Auth;

use App\Models\Invitation;
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
            // session()->put('in_route','lambo');
             $route = session()->get('in_route') ?? '/dashboard';
            // $user = Socialite::driver('google')->stateless()->user();
            $socialiteUser = Socialite::driver($provider)->stateless()->user();
            // $existingUser = User::where('email', $socialiteUser->email)->first();
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
            return redirect($route);


    }
}
