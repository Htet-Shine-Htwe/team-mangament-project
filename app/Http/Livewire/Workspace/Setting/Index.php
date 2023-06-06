<?php

namespace App\Http\Livewire\Workspace\Setting;

use App\Models\Workspace;
use App\Storage\S3FileStorage;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $workspace;

    public $workspaceName;

    public $confirmWorkspaceName;

    public $logo;

    protected $storage;

    public $workspaceLogo;

    public function boot(S3FileStorage $storage )
    {
        $this->storage = $storage;
    }

    public function mount()
    {
        $this->workspace =  Session::get('selected_workspace');
        $this->workspaceName = makeWorkspaceLogo($this->workspace->name);
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

        session()->put('selected_workspace', $currentWorkspace);

        $this->workspaceLogo = $this->storage->getPhoto($photoName,'workspaceLogo');
    }

    public function deleteWorkspace()
    {
        dd('deleted');
    }

}
