<?php

namespace App\Http\Livewire\Layouts;

use App\Models\Workspace;
use App\Storage\S3FileStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Sidebar extends Component
{
    public $workspaces;
    public $currentWorkspace ;

    public string $photo;
    public string $workspaceName;

    public $workspaceLogo;

    protected $storage;
    public string $haxColor;

    public function boot(S3FileStorage $storage )
    {
        $this->storage = $storage;
    }

    public function mount()
    {
        $this->workspaces = Auth::user()->workspaces;
        $this->currentWorkspace =  Session::get('selected_workspace') ?? Auth::user()->workspaces[0];

        $this->photo = $this->outputPhoto($this->currentWorkspace?->logo_path);
        $this->workspaceName = makeWorkspaceLogo($this->currentWorkspace?->name);
        $this->haxColor = $this->currentWorkspace?->hax_color;

        $this->workspaceLogo = $this->storage->getPhoto($this->currentWorkspace?->logo_path,'workspaceLogo');

    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        return view('livewire.layouts.sidebar');
    }

    public function switchWorkspace($workspaceName)
    {
        $workspace = Workspace::where('name',$workspaceName)->first();

        session()->put('selected_workspace', $workspace);

        return redirect()->route('workspace.index',['workspace' => $workspaceName]);
    }

    protected function outputPhoto(?string $photo)
    {
        return $photo != null ? true : false;
    }


}
