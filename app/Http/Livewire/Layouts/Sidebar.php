<?php

namespace App\Http\Livewire\Layouts;

use App\Models\Workspace;
use App\Services\WorkspaceHelper;
use App\Storage\S3FileStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class Sidebar extends Component
{
    public $workspaces;
    public $currentWorkspace ;
    public string $workspaceName;

    public $workspaceLogo;

    protected $storage;
    public string $haxColor;

    public function boot(S3FileStorage $storage ) :void
    {
        $this->storage = $storage;
    }

    public function mount() :void
    {
        $this->workspaces = WorkspaceHelper::getUserWorkspaces();
        $this->currentWorkspace = WorkspaceHelper::getCurrentWorkspace();
        $this->workspaceName = makeWorkspaceLogo($this->currentWorkspace?->name);
        $this->haxColor = $this->currentWorkspace?->hax_color;

        // $this->workspaceLogo = $this->storage->getPhoto($this->currentWorkspace?->logo_path,'workspaceLogo');
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render() :View
    {
        return view('livewire.layouts.sidebar');
    }

    public function switchWorkspace($workspaceName) :Redirector
    {
        $workspace = Workspace::where('name',$workspaceName)->first();

        session()->put('selected_workspace', $workspace->id);

        return redirect()->route('workspace.index',['workspace_name' => $workspaceName]);
    }




}
