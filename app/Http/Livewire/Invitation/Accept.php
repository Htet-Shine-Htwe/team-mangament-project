<?php

namespace App\Http\Livewire\Invitation;

use App\Enums\InvitationStatus;
use App\Models\Invitation;
use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use App\Services\RouteRedirectService;
use App\Storage\S3FileStorage;
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

    private $storage;

    public $workspaceLogo;

    public $workspaceName;

    public string $redirectRoute;

    public function boot(S3FileStorage $storage ) :void
    {
        $this->storage = $storage;
    }
    public function mount() :void
    {
        $this->invitation = $this->getAcceptWorkspace();
        session()->put('invitation',$this->invitation);
        $this->workspace = $this->invitation->workspace;

        $this->checkUserInWorkspace();

        $this->sender = $this->invitation->sender;
        $this->redirectRoute = $this->getRedirectRoute();
        $this->workspaceName = makeWorkspaceLogo($this->workspace->name);
        $this->workspaceLogo = $this->storage->getPhoto($this->workspace->logo_path,'workspaceLogo');

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

            $this->invitation->update([
                'status' => InvitationStatus::ACCEPTED->value
            ]);

            $allInvitations = Invitation::where('email',Auth::user()->email)
            ->where('workspace_id',$this->workspace->id)
            ->where('status',InvitationStatus::PENDING->value)->get();

            if(count($allInvitations) > 0){
                foreach($allInvitations as $invitation)
                {
                    $invitation->delete();
                }
            }
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

    protected function checkUserInWorkspace()
    {
        $user = Auth::user()->email;
        $emails = $this->workspace->users()->pluck('email')->toArray();
        if(in_array($user,$emails))
        {
            return redirect()->route('workspace.setting.member', $this->workspace->name);
        }
    }
}
