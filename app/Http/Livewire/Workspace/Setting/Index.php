<?php

namespace App\Http\Livewire\Workspace\Setting;

use App\Models\Workspace;
use App\Services\WorkspaceHelper;
use App\Services\WorkspaceUpdateService;
use App\Storage\S3FileStorage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
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


    public function boot(S3FileStorage $storage ,WorkspaceUpdateService $workspaceUpdateService) :void
    {
        $this->storage = $storage;
        $this->workspaceUpdateService = $workspaceUpdateService;
    }


    public function mount() :void
    {

        $this->workspace = WorkspaceHelper::getCurrentWorkspace();
        $this->workspaceName = makeWorkspaceLogo($this->workspace->name);
        $this->name = $this->workspace->name;
        $this->workspaceLogo = $this->storage->getPhoto($this->workspace->logo_path,'workspaceLogo');
        // dd($this->workspace);

    }
    public function render() :View
    {
        return view('livewire.workspace.setting.index');
    }


    public function updatedLogo() :void
    {
        $this->validate([
            'logo' =>  'max:3072|mimes:jpeg,png,jpg',
        ]);
        // dd('here');
        $photoName = $this->storage->storePhotos($this->logo,'workspace/logo');
        $currentWorkspace = Workspace::where('id',$this->workspace->id)->first();
        $currentWorkspace->logo_path = $photoName;
        $currentWorkspace->save();

        $this->sessionRefresh($currentWorkspace);

        $this->workspaceLogo = $this->storage->getPhoto($photoName,'workspaceLogo');
    }
    public function updateWorkspace() :Redirector
    {
        $this->validate([
            'name' =>  'required|min:3',
        ]);
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

    protected function sessionRefresh($workspace) :void
    {
        session()->forget('selected_workspace');
        session()->put('selected_workspace', $workspace->id);
    }
}
