<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileComponent extends Component
{
    public $user;
    public $user_name;

    public $disable_delete = true;
    public $confirm_user_name;
    public function mount(Request $request)
    {
        $this->user =  $request->user();
        if(!$this->user == null)
        {
            $this->user_name = $this->user->name;
        }
    }

    public function render()
    {
        return view('profile.edit');
    }

    public function updateProfile()
    {
        $updated_user = User::where('id',Auth::id())->first();
        // dd($updated_user);
        $updated_user->name = $this->user_name;
        $updated_user->update();

        session()->flash('status', 'profile successfully updated.');
    }

    public function updatedConfirmUserName()
    {
        if($this->confirm_user_name == $this->user_name)
        {
            $this->disable_delete = false;
        }
        $this->disable_delete = true;
    }

    public function deleteProfile()
    {
        $this->validate([
            'confirm_user_name' => ['required'],
        ]);


        $user = User::where('id',Auth::id())->first();

        if($this->confirm_user_name == $user->name)
        {
            Auth::logout();

            $user->delete();

            session()->invalidate();
            session()->regenerateToken();

            redirect()->to('/login');
        }
        session()->flash('confirm','name is not matched');
    }
}
