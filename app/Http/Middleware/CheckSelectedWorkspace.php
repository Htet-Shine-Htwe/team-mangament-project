<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserWorkspace;
use App\Services\WorkspaceHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckSelectedWorkspace
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
            // session()->flush();

            $selectedWorkspace = WorkspaceHelper::getCurrentWorkspace();
            //if selectedWorkspace fail,forget the session and try again
            $userWorkspaces =   WorkspaceHelper::getUserWorkspaces();


            if ($selectedWorkspace !== null && $this->userHasAccessToWorkspace($selectedWorkspace->id)) {
                return $next($request);
            }

            if ($userWorkspaces->isNotEmpty()) {
                $workspace = $userWorkspaces->first()->id;
                $request->session()->put('selected_workspace', $workspace);
                return $next($request);
            }

            abort(403, 'Unauthorized access to the workspace.');

    }

    private function userHasAccessToWorkspace($workspaceId)
    {
        return WorkspaceHelper::checkUserHasAccessToWorkspace($workspaceId);
    }
}
