<?php

namespace App\Http\Livewire\Workspace\Setting;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public $workspace;

    public $confirmWorkspaceName;


    public function mount()
    {
        $this->workspace =  Session::get('selected_workspace');

    }
    public function render()
    {
        return view('livewire.workspace.setting.index');
    }

    public function deleteWorkspace()
    {
        dd('deleted');
    }
}
