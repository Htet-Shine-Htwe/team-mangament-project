<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateService
{
    public function deleteAccount(string $confirm_user_name)
    {
        $user = User::where('id', Auth::id())->first();

        if ($confirm_user_name == $user->name)
        {
            Auth::logout();

            $user->delete();

            session()->invalidate();
            session()->regenerateToken();
            return redirect()->to('/login');
        }
        dd('here');
        session()->flash('confirm', 'name is not matched');
    }
}
