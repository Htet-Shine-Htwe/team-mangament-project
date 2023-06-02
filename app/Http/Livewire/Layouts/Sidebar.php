<?php

namespace App\Http\Livewire\Layouts;

use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public $workspaces;
    public function mount()
    {
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
        $workspace = Workspace::where('name',$workspaceName)->first();

        session()->put('selected_workspace', $workspace);

        return redirect()->route('workspace.index',['workspace' => $workspaceName]);
    }

}
