<?php

namespace App\Http\Livewire\Workspace\Setting;

use App\Models\Workspace;
use App\Services\WorkspaceHelper;
use App\Services\WorkspaceUpdateService;
use App\Storage\S3FileStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $workspace;
    public $workspaceName;

    public $name;

    public $confirmWorkspaceName;

    public $logo;

    protected $storage;

    public $workspaceLogo;

    protected $workspaceUpdateService;

    public function boot(S3FileStorage $storage ,WorkspaceUpdateService $workspaceUpdateService)
    {
        $this->storage = $storage;
        $this->workspaceUpdateService = $workspaceUpdateService;
    }

    public function mount()
    {

        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        $this->workspaceName = makeWorkspaceLogo($this->workspace->name);
        $this->name = $this->workspace->name;
        $this->workspaceLogo = $this->storage->getPhoto($this->workspace->logo_path,'workspaceLogo');
        // dd($this->workspace);

    }
    public function render()
    {
        return view('livewire.workspace.setting.index');
    }

    public function updatedLogo()
    {
        $photoName = $this->storage->storePhotos($this->logo,'workspace/logo');
        $currentWorkspace = Workspace::where('id',$this->workspace->id)->first();
        $currentWorkspace->logo_path = $photoName;
        $currentWorkspace->save();

        $this->sessionRefresh($currentWorkspace);

        $this->workspaceLogo = $this->storage->getPhoto($photoName,'workspaceLogo');
    }
    public function updateWorkspace()
    {
        $currentWorkspace = Workspace::where('id',$this->workspace->id)->first();
        $currentWorkspace->name = $this->name;
        $currentWorkspace->save();

        $this->sessionRefresh($currentWorkspace);
        return redirect()->route('workspace.setting.index',['workspace_name' => $currentWorkspace->name ]);
    }
    public function deleteWorkspace()
    {
        $this->validate([
            'confirmWorkspaceName' => 'required',
        ]);

        return $this->workspaceUpdateService->deleteWorkspace($this->confirmWorkspaceName);
    }

    protected function sessionRefresh($workspace)
    {
        session()->forget('selected_workspace');
        session()->put('selected_workspace', $workspace->id);
    }
}
