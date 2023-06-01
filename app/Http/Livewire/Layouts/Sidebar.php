<?php

namespace App\Http\Livewire\Layouts;

use App\Models\UserWorkspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sidebar extends Component
{
    public $workspaces ;
    public $user;
    public function mount()
    {
        $this->user = Auth::user();
        $this->workspaces = UserWorkspace::getUserWorkspaces()
        ->get();
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        return view('livewire.layouts.sidebar');
    }
}
