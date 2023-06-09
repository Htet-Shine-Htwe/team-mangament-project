<?php

namespace App\Http\Middleware;

use App\Enums\InvitationStatus;
use App\Services\RouteRedirectService;
use Closure;
use Illuminate\Http\Request;

class RedirectInvitation
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
        $url = session()->get('url.intended') ?? null;

        $invitationId = getInvitationId($url);

        $invitation = RouteRedirectService::getInvitation($invitationId);

        if($invitation && $invitation->status != InvitationStatus::ACCEPTED->value){
            session()->put('in_route',$url);
            $set = RouteRedirectService::getRoute($url);
        }

        return $next($request);
    }
}
