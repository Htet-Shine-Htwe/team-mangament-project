<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    public $users;
    public $user;
    public function mount()
    {
        $this->users = User::all();
        $this->user = Auth::user();
        // $this->user->created_at = diffForHumans($this->user->created_at) ;
    }

    public function render()
    {
        return view('livewire.profile.index');
    }
}
