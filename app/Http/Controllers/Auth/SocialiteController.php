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
            $socialiteUser = Socialite::driver($provider)->user();
            $existingUser = User::where('email', $socialiteUser->email)->first();

            // dd($socialiteUser);
            $user = User::updateOrCreate([
                'provider' => $provider,
                'provider_id' => $socialiteUser->getId(),
                'profile_photo_path' => $socialiteUser->avatar
            ], [
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
            ]);
            // dd($user);
            Auth::login($user);

            return redirect('/dashboard');


    }
}
