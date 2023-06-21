<?php

namespace App\Http\Middleware;

use App\Models\Workspace;
use App\Services\WorkspaceHelper;
use Closure;
use Illuminate\Support\Facades\Auth;

class WorkspaceAccess
{
    public function handle($request, Closure $next)
    {
        $getWorkspace =  $request->route('workspace_name');
        $workspaceName = str_replace('+', ' ', $getWorkspace);
        $workspace = Workspace::where('name',$workspaceName)->first();

        $currentWsName = WorkspaceHelper::getCurrentWorkspace()?->name;

        if (!$currentWsName || $currentWsName !== $workspaceName) {
            session()->forget('selected_workspace');
            session()->put('selected_workspace', $workspace->id);
        }


        if(!$workspace)
        {
            return redirect()->route('dashboard')->with('error', 'Workspace does not exists');

        }
        $workspaceId = $workspace->id;

        if (!WorkspaceHelper::checkUserHasAccessToWorkspace($workspaceId)) {
            // User is not authorized, return an error response or redirect
            return redirect()->route('dashboard')->with('error', 'You do not have access to this workspace.');
        }

        // User is authorized, allow the request to proceed
        return $next($request);
    }
}
