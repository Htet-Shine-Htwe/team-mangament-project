<?php

namespace App\Http\Middleware;

use App\Models\Workspace;
use Closure;
use Illuminate\Support\Facades\Auth;

class WorkspaceAccess
{
    public function handle($request, Closure $next)
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        $getWorkspace =  $request->route('workspace_name');
        $workspaceName = str_replace('+', ' ', $getWorkspace);
        // dd($workspaceName);
        $workspace = Workspace::where('name',$workspaceName)->first();

        // dd($workspace);
        if(!$workspace)
        {
            return redirect()->route('dashboard')->with('error', 'Workspace does not exists');

        }
        // Retrieve the requested workspace ID from the route parameters or request input
        $workspaceId = $workspace->id;
        // Alternatively, you can retrieve the workspace ID from request input, query parameters, etc.
        // $workspaceId = $request->input('workspace_id');

        // Check if the user has access to the requested workspace
        if (!$user->hasAccessToWorkspace($workspaceId)) {
            // User is not authorized, return an error response or redirect
            return redirect()->route('dashboard')->with('error', 'You do not have access to this workspace.');
        }

        // User is authorized, allow the request to proceed
        return $next($request);
    }
}
