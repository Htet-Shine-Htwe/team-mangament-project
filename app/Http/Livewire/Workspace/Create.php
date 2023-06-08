<?php

namespace App\Http\Livewire\Workspace;

use App\Models\UserWorkspace;
use App\Models\Workspace;
use App\View\Components\PlainLayout;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class Create extends Component
{
    public $workspaceName;

    protected $rules = [
        'workspaceName' => 'required|min:2|unique:workspaces,name'
    ];

    public function mount() :void
    {
        // dd('here');
    }
    public function render() :View
    {
        return view('livewire.workspace.create')->layout(PlainLayout::class);
    }

    public function save() :Redirector
    {
        $this->validate();

        $workspace = $this->createWorkspace();

        session()->put('selected_workspace', $workspace->id);

        return redirect()->route('dashboard');

    }

    protected function createWorkspace() :Workspace
    {
        $workspace = Workspace::create([
            'name' => $this->workspaceName,
            'hax_color' => fake()->safeHexColor(),
        ]);

        UserWorkspace::create([
            'user_id' => Auth::user()->id,
            'workspace_id' => $workspace->id
        ]);

        return $workspace;
    }
}
