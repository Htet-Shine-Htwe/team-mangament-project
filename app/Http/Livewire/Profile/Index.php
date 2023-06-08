<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{

    public $user;

    public $workspaces;
    public function mount() :void
    {
        $this->user = Auth::user();
    }

    public function render() :View
    {
        return view('livewire.profile.index');
    }
}
