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
        // session()->flush();
        // $sessionData = session()->all();
        // dd($sessionData);

        // // Additional validation or logic if required
        // dd($selectedWorkspaceId);
        // dd($this->userHasAccessToWorkspace( $selectedWorkspaceId->id));
        if ($selectedWorkspaceId !== null) {
            // Perform necessary checks to ensure the user has access to the selected workspace
            if ($this->userHasAccessToWorkspace($selectedWorkspaceId->id)) {
                return $next($request);
            } else {
                // Handle unauthorized access to the workspace
                abort(403, 'Unauthorized access to the workspace.');
            }
        } else {
            $workspaceId = Auth::user()->workspaces[0]->id;
            $request->session()->put('selected_workspace', $workspaceId);
            // Handle the case where no workspace is selected
            // abort(400, 'No workspace selected.');
        }
        // return $next($request);

    }

    private function userHasAccessToWorkspace($workspaceId)
    {
        return Auth::user()->workspaces->contains('id', $workspaceId);
    }
}
