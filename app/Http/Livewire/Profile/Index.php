<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{

    public $user;

    public $workspaces;
    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.profile.index');
    }
}
