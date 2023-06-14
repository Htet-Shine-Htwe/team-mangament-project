<?php

namespace App\Http\Middleware;

use App\Enums\InvitationStatus;
use App\Models\Invitation;
use App\Services\RouteRedirectService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationCheck
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

        $url = request()->fullUrl() ?? null;
        $invitationId = getInvitationId($url);

        $invitation = RouteRedirectService::getInvitation($invitationId);


        $this->checkInvitationStatus($invitation);//check invitation exist or accepted?
        $this->checkInvitationUser($invitation);
        return $next($request);
    }


    protected function  checkInvitationStatus($invitation)
    {
        if(!$invitation || $invitation->status == InvitationStatus::ACCEPTED->value)
        {
            return abort(403,'Invitation not found or already accepted');
        }
    }

    protected function checkInvitationUser(Invitation $invitation)
    {
        if($invitation->email != Auth::user()->email)
        {
            return abort(401);
        }
    }
}
