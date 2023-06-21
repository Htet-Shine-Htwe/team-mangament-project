<?php

namespace App\Http\Middleware;

use App\Services\WorkspaceHelper;
use Closure;
use Illuminate\Http\Request;

class CheckMemberInWorkspace
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
        $workspaceName = $request->route('workspace_name');
        $workspace = WorkspaceHelper::getCurrentWorkspace() ?? abort(403, 'Unauthorized access to the workspace.');

        $members = $workspace->users()->pluck('email');
        $member = $request->route('email');
        if(!$members->contains($member))
        {
            abort(403, 'Unauthorized access to view the person ');
        }

        return $next($request);
    }
}
