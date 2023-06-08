<?php

namespace App\Http\Livewire\Workspace;


use App\Services\WorkspaceHelper;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public $workspace ;

    public function mount(Request $request) :void
    {

        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        // dd($this->workspace);
    }
    public function render() :View
    {
        return view('livewire.workspace.index');
    }

}
