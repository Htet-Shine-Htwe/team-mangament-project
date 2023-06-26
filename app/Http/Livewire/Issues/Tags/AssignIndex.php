<?php

namespace App\Http\Livewire\Issues\Tags;

use App\Services\WorkspaceHelper;
use Livewire\Component;

class AssignIndex extends Component
{
    public $users;

    public $currentAssign;

    public function mount($currentAssign)
    {
        $workspace = WorkspaceHelper::getCurrentWorkspace();
        $this->users = $workspace->users;
        $this->currentAssign = $currentAssign ?? [];
        // dd($this->users);
    }

    public function render()
    {
        return view('livewire.issues.tags.assign-index');
    }

    public function changeAssign($id)
    {
        $this->currentAssign = $this->users->find($id) ?? [];
        $this->emit('changeAssign', $this->currentAssign);
    }
}
