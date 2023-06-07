<?php

namespace App\Http\Livewire\Workspace;

use App\Models\Workspace;
use App\Services\WorkspaceHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public $workspace ;

    public function mount(Request $request)
    {

        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        // dd($this->workspace);
    }
    public function render()
    {
        return view('livewire.workspace.index');
    }

}
