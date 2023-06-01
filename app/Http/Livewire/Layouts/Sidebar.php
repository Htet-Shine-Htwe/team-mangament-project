<?php

namespace App\Http\Livewire\Layouts;

use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sidebar extends Component
{

    public $workspaces ;
    public $user;


    public function mount()
    {
        // $this->user = User::where('id',auth()->id())->with('workspaces')->first();
        $this->workspaces = Auth::user()->workspaces;
        // dd($this->workspaces);
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        return view('livewire.layouts.sidebar');
    }

    public function switchWorkspace($workspaceName)
    {
        // dd($workspaceName);
        $workspaceId = Workspace::where('name',$workspaceName)->first()->id;

        session()->put('selected_workspace', $workspaceId);

        return redirect()->route('workspace.index',['workspace' => $workspaceName]);
    }

    public function save()
    {
        dd('here');
    }
}
