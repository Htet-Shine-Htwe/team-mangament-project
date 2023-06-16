<?php

namespace App\Http\Livewire\Workspace\Setting\Member;

use App\Models\Invitation;
use App\Models\User;
use App\Services\WorkspaceHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $workspace;
    public $workspaceUsers;
    public string $memberName;
    public $selectedUser ;
    public $limit = 4;
    public $invitations;

    public $removeModel = false;

    public $adminCheck = false;

    protected $listeners = [

        'modelClosed' => 'closeModel',
    ];

    public function mount(Request $request) :void
    {
        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        $this->workspaceUsers = $this->getMembers();
        $this->adminCheck = checkWorkspaceAdmin();
        if($this->adminCheck)
        {
            $this->invitations = $this->getPendingInvitations($this->limit);
        }
        $this->selectedUser = $this->workspaceUsers->first();

    }
    public function render() :View
    {
        return view('livewire.workspace.setting.member.index',['invitations' => $this->invitations]);
    }

    public function updatedMemberName() :void
    {
        $this->workspaceUsers= $this->getMembers($this->memberName);
        // dd($members);
    }

    public function getMembers(?string $memberName ="")
    {
        return User::select('users.id', 'users.name', 'users.email', 'users.avatar', 'users.status', 'users.profile_photo_path', 'roles.name as role')
        ->join('user_workspace', 'user_workspace.user_id', '=', 'users.id')
        ->join('roles', 'user_workspace.role_id', '=', 'roles.id')
        ->where('user_workspace.workspace_id', $this->workspace->id)
        ->when($memberName != "", function ($q) use ($memberName) {
            $q->where(function ($query) use ($memberName) {
                $query->where('users.name', 'like', '%' . $memberName . '%')
                    ->orWhere('users.email', 'like', '%' . $memberName . '%');
            });
        })
        ->get();

    }

    public function getPendingInvitations(int $limit)
    {
       return DB::table('invitations')
        ->select('invitations.id', 'invitations.email', 'invitations.status', 'invitations.created_at', 'invitations.updated_at')
        ->where('invitations.workspace_id', $this->workspace->id)
        ->where('invitations.status', 'pending')
        ->latest('invitations.id')
        ->limit($limit)
        ->get()->toArray();
    }

    protected function totalInvitationCount() :int
    {
        return DB::table('invitations')
        ->where('invitations.workspace_id', $this->workspace->id)
        ->where('invitations.status', 'pending')
        ->latest('invitations.id')
        ->get()->count();
    }

    public function moreInvitations() :void
    {
        $this->limit += 4;
        $this->invitations = $this->getPendingInvitations($this->limit);

        if(count($this->invitations) == $this->totalInvitationCount()){
            session()->flash('invitation',"No more invitations to load");
        }
    }

    public function removeMember($user) :void
    {
        $this->removeModel = true;
        $this->selectedUser = $user;
    }

    public function closeModel() :void
    {
        $this->removeModel = false;
    }


}
