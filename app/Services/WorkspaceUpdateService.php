<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WorkspaceUpdateService
{
    public function deleteWorkspace(string $confirm_workspaceName)
    {
        $workspace = Session::get('selected_workspace');

        if ($confirm_workspaceName == $workspace->name)
        {

            $workspace->delete();

            $userWorkspaces = User::where('id',auth()->id())->with('workspaces')->first();

            if(count($userWorkspaces->workspaces) <= 0)
            {
                return redirect()->route('workspace.create');
            }
            //get the other workspace with  workspace model expect the deleted one
            $latestWorkspace = $userWorkspaces->workspaces[0];
            Session::put('selected_workspace', $latestWorkspace);

            return redirect()->to('/dashboard');
        }

        session()->flash('confirm', 'workspace name is not matched');
    }
}
