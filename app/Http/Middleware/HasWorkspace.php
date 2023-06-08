<?php

namespace App\Http\Middleware;

use App\Models\UserWorkspace;
use App\Services\WorkspaceHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class HasWorkspace
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $workspaceCount =WorkspaceHelper::getUserWorkspaces()->count();
        $currentEndpoint = (string) $request->getRequestUri();
        if($workspaceCount <= 0)
        {
            if ( $currentEndpoint == '/create/workspace') {

                return $next($request);
            }

            return redirect()->route('workspace.create');
        }

        return $next($request);
    }
}
