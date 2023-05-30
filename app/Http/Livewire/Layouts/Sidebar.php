<?php

namespace App\Http\Livewire\Layouts;

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
        $this->workspaces = DB::table('user_workspace')
        ->select('workspaces.name','workspaces.logo_path')
        ->where('user_id',Auth::user()->id)
        ->join('workspaces','user_workspace.workspace_id','=','workspaces.id')
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
