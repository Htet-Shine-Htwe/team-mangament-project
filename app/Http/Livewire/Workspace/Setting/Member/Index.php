<?php

namespace App\Http\Livewire\Workspace\Setting\Member;

use App\Services\WorkspaceHelper;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    public $workspace ;

    public function mount(Request $request) :void
    {

        $this->workspace = WorkspaceHelper::getCurrentWorkspace();

    }
    public function render()
    {
        return view('livewire.workspace.setting.member.index');
    }
}
