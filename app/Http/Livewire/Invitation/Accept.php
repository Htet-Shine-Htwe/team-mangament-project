<?php

namespace App\Http\Livewire\Invitation;

use App\Enums\InvitationStatus;
use App\Models\Invitation;
use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use App\Services\RouteRedirectService;
use App\View\Components\PlainLayout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class Accept extends Component
{

    public Invitation $invitation;
    public Workspace $workspace ;
    public User $sender;
    public User $user;

    public string $redirectRoute;

    public function mount() :void
    {
        $this->invitation = $this->getAcceptWorkspace();
        $this->workspace = $this->invitation->workspace;
        $this->sender = $this->invitation->sender;
        $this->redirectRoute = $this->getRedirectRoute();

    }

    public function getAcceptWorkspace() :Invitation
    {
        if(!request()->hasValidSignature())
        {
            return abort(401);
        }
        return RouteRedirectService::$invitation;
    }

    public function acceptWorkspace()
    {
        $userWorkspace = UserWorkspace::create([
            'user_id' => Auth::user()->id,
            'workspace_id' => $this->workspace->id,
        ]);

        // dd(Auth::user()->workspaces);
        $this->invitation->update([
            'status' => InvitationStatus::ACCEPTED->value
        ]);
        //
        return redirect()->route('profile.index');
    }


    public function render() :View
    {
        return view('livewire.invitation.accpet')->layout(PlainLayout::class);
    }

    protected function getRedirectRoute()
    {
        $url = url()->current() . '?signature='.request()->signature;
        session()->put('redirect_route', $url);
        return $url;
    }
}
