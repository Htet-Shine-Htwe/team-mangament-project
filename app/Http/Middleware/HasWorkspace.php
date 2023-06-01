<?php

namespace App\Http\Middleware;

use App\Models\UserWorkspace;
use Closure;
use Illuminate\Http\Request;

class HasWorkspace
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illumginate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $workspaceCount = UserWorkspace::where('user_id', auth()->id())
            ->join('workspaces', 'user_workspace.workspace_id', '=', 'workspaces.id')
            ->count();
        if($workspaceCount <= 0)
        {
            return redirect()->route('workspace.create');
        }

        return $next($request);
    }
}
