<?php

namespace App\Http\Livewire\Workspace\Setting\Member;

use Livewire\Component;

class RemoveMember extends Component
{
    public $user;
    public $workspace;

    public function render()
    {
        return view('livewire.workspace.setting.member.remove-member',['user' => $this->user, 'workspace' => $this->workspace]);
    }

    public function mount($user, $workspace)
    {
        $this->user = $user;
        $this->workspace = $workspace;
    }

    public function close()
    {
        $this->emit('modelClosed');
    }
}
