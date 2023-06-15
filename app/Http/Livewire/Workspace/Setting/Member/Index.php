<?php

namespace App\Http\Livewire\Workspace\Setting\Member;

use App\Models\Invitation;
use App\Services\WorkspaceHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $workspace ;
    public $workspaceUsers;
    public string $memberName;

  
    public function mount(Request $request) :void
    {

        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        $this->workspaceUsers = $this->getMembers();
       
    }
    public function render()
    {
        return view('livewire.workspace.setting.member.index',[
            'pandads' => $this->getPendingInvitations()
        ]);
    }

    public function updatedMemberName()
    {
        $this->workspaceUsers= $this->getMembers($this->memberName);
        // dd($members);
    }

    public function getMembers(?string $memberName ="")
    {
        return DB::table('user_workspace')
        ->select('users.id', 'users.name', 'users.email', 'users.avatar', 'users.status', 'users.profile_photo_path', 'roles.name as role')
        ->join('users', 'user_workspace.user_id', '=', 'users.id')
        ->join('roles', 'user_workspace.role_id', '=', 'roles.id')
        ->where('user_workspace.workspace_id', $this->workspace->id)
        ->when($memberName != "",function($q) use ($memberName){
            $q->where(function ($query) use ($memberName) {
                $query->where('users.name', 'like', '%' . $memberName . '%')
                    ->orWhere('users.email', 'like', '%' . $memberName . '%');
            });
        })
        ->get();
    }

    public function getPendingInvitations()
    {
       return DB::table('invitations')
        ->select('invitations.id', 'invitations.email', 'invitations.status', 'invitations.created_at', 'invitations.updated_at')
        ->where('invitations.workspace_id', $this->workspace->id)
        ->where('invitations.status', 'pending')
        ->latest('invitations.id')
        ->paginate(4);

    }


}
