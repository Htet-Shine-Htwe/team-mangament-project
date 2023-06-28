<?php

namespace App\Http\Livewire\Issues\Tags;

use App\Models\UserWorkspace;
use App\Services\IssueInfoHelper;
use App\Services\WorkspaceHelper;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class AssignIndex extends Component
{
    public $users;

    public $currentAssign;

    public function mount($currentAssign)
    {

        $this->users = WorkspaceHelper::getCurrentWorkspaceUsers();

        $this->currentAssign = $currentAssign ?? [];
    }

    public function render()
    {
        return view('livewire.issues.tags.assign-index');
    }

    public function changeAssign($id)
    {
        $this->currentAssign = $this->users[$id] ?? [];
        // dd($this->currentAssign);
        $this->emit('changeAssign', $this->currentAssign);
    }
}
