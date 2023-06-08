<?php

namespace App\Http\Livewire\Invitation;

use App\Models\Invitation;
use App\View\Components\PlainLayout;
use Livewire\Component;

class Accept extends Component
{

    public $invitation;
    public $workspace ;

    public function mount()
    {
        $this->invitation = $this->getAcceptWorkspace();
        $this->workspace = $this->invitation->workspace;
    }

    public function getAcceptWorkspace()
    {
        if(!request()->hasValidSignature())
        {
            return abort(401);
        }

        return Invitation::where('id',request()->invitationId)->first();
    }


    public function render()
    {
        return view('livewire.invitation.accpet')->layout(PlainLayout::class);
    }
}
