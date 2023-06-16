<?php

namespace App\Http\Livewire\Workspace\Setting\Member;

use App\Models\UserWorkspace;
use Exception;
use Livewire\Component;

class RemoveMember extends Component
{
    public $user;
    public $workspace;

    public $adminCheck = false;

    public $warning = false;

    public function render()
    {
        return view('livewire.workspace.setting.member.remove-member',['user' => $this->user, 'workspace' => $this->workspace]);
    }

    public function mount($user, $workspace)
    {
        $this->user = $user;
        $this->workspace = $workspace;
        $this->adminCheck = checkWorkspaceAdmin();
        $this->warning = $this->checkWorkspaceMember();
    }

    public function removeFromWorkspace()
    {
        try{
            if($this->adminCheck)
            {
                $workspace = UserWorkspace::where('user_id', $this->user['id'])
                ->where('workspace_id', $this->workspace['id'])
                ->first();
                $workspace->delete();
                if($this->warning){
                    $this->workspace->delete();
                    session()->flash('status', 'Workspace was deleted successfully');
                }
                else{
                    session()->flash('status', 'Member removed successfully');
                }
                return redirect()->route('workspace.setting.member', $this->workspace['name']);
            }
            return abort(401, 'You are not authorized to perform this action.');
        }
        catch(\Exception $e)
        {
            return dd(['error' => $e->getMessage()]);
        };
    }

    public function close()
    {
        $this->emit('modelClosed');
    }

    protected function checkWorkspaceMember()
    {
        return count($this->workspace->users) == 1 ? true : false;
    }
}
