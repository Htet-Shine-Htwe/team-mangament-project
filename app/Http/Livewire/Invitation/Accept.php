<?php

namespace App\Http\Livewire\Invitation;

use App\Enums\InvitationStatus;
use App\Models\Invitation;
use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use App\Services\RouteRedirectService;
use App\View\Components\PlainLayout;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class Accept extends Component
{

    public $invitation;
    public Workspace $workspace ;
    public User $sender;
    public User $user;

    public $nn ;

    public string $redirectRoute;

    public function mount() :void
    {
        $this->invitation = $this->getAcceptWorkspace();
        session()->put('invitation',$this->invitation);
        $this->workspace = $this->invitation->workspace;
        $this->sender = $this->invitation->sender;
        $this->redirectRoute = $this->getRedirectRoute();
        // dd($this->invitation);
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
        $invitation = session()->get('invitation');
        if($invitation->status == InvitationStatus::ACCEPTED->value)
        {
            return abort(403,'You have already accepted this invitation');
        }
        DB::beginTransaction();
        try{
            $userWorkspace = UserWorkspace::create([
                'user_id' => Auth::user()->id,
                'workspace_id' => $this->workspace->id,
                'role_id' => 2
            ]);

            // dd(Auth::user()->workspaces);
            $this->invitation->update([
                'status' => InvitationStatus::ACCEPTED->value
            ]);
            DB::commit();
            session()->forget('invitation');
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return abort(403,'Something went wrong');
        }

        return redirect()->route('profile.index',['email' => Auth::user()->email]);
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
