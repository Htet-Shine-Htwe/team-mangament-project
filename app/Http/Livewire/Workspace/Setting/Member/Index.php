<?php

namespace App\Http\Livewire\Workspace\Setting\Member;

use App\Enums\InvitationStatus;
use App\Http\Controllers\InvitationController;
use App\Models\Invitation;
use App\Models\User;
use App\Services\WorkspaceHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Index extends Component
{
    public $workspace ;

    public $emails ;
    public $sendEmail;

    public $error = false;

    protected $rules = [
        'sendEmail' => 'required|email'
    ];
    public function mount(Request $request) :void
    {

        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        $this->emails = $this->workspace->users()->pluck('email')->toArray();

    }
    public function render()
    {
        return view('livewire.workspace.setting.member.index');
    }

    public function invite()
    {
        $this->validate();
        $this->emailCheck();
        $this->alreadyInvited();
        if(!$this->error)
        {
            $workspaceId = $this->workspace->id;

            DB::beginTransaction();

            try{
                $url = (new InvitationController)->generateInvitation(auth()->id(),$workspaceId,$this->sendEmail);

                $route = URL::signedRoute('workspace.invitation',['invitationId' => $url['id']]);

                Auth::user()->notify(new \App\Notifications\WorkspaceInvitationNotification($route,$this->workspace->name,$this->sendEmail));

                DB::commit();
                session()->flash('status','This invitation was sent successfully !');
            }
            catch(Exception $e){
                DB::rollback();
                throw new \ErrorException('something went wrong');
            }


        }

    }

    protected function emailCheck()
    {
        if(in_array($this->sendEmail,$this->emails))
        {
            session()->flash('sendEmail','This email is already a member of this workspace');
            return $this->error = true;;
        }
        return $this->error = false;;
    }

    protected function alreadyInvited()
    {
        $invitation = Invitation::where('workspace_id',$this->workspace->id)
            ->where('email',$this->sendEmail)
            ->where('status',InvitationStatus::PENDING->value)
            ->first();
        if($invitation)
        {
            session()->flash('sendEmail','This email is already invited to this workspace');
            return $this->error = true;;
        }
        return $this->error = false;;

    }
}
