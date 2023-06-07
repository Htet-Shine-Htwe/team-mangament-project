<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserWorkspace;
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

            $selectedWorkspace = Session::get('selected_workspace');

            $userWorkspaces = User::where('id',auth()->id())->with('workspaces')->first();

            if ($selectedWorkspace !== null) {
                if ($this->userHasAccessToWorkspace($selectedWorkspace->id)) {
                    return $next($request);
                } else {

                    abort(403, 'Unauthorized access to the workspace.');
                }
            } else {
                $workspace = $userWorkspaces->workspaces[0];

                $request->session()->put('selected_workspace', $workspace);
                return $next($request);
            }



    }

    private function userHasAccessToWorkspace($workspaceId)
    {
        return  Auth::user()->workspaces->contains('id', $workspaceId);
    }
}
