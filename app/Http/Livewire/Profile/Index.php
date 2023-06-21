<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Services\WorkspaceHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{

    public $user;

    public $workspace;
    public function mount(Request $request) :void
    {
        $this->user = User::where('email',$request->email)->first();
        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        if(!$this->user)
        {
            abort(403,'user not found');
        }
        // dd($this->user);
    }

    public function render() :View
    {
        return view('livewire.profile.index');
    }
}
