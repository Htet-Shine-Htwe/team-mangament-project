<?php

namespace App\Http\Middleware;

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
        $selectedWorkspaceId = Session::get('selected_workspace');

        if ($selectedWorkspaceId !== null) {
            if ($this->userHasAccessToWorkspace($selectedWorkspaceId)) {
                return $next($request);
            } else {
                abort(403, 'Unauthorized access to the workspace.');
            }
        } else {
            $workspaceId = Auth::user()?->workspaces[0];
            $request->session()->put('selected_workspace', $workspaceId);
        }
    }

    private function userHasAccessToWorkspace($workspaceId)
    {
        return  Auth::user()->workspaces->contains('id', $workspaceId);
    }
}
