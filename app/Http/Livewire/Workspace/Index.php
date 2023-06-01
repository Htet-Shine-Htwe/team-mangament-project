<?php

namespace App\Http\Livewire\Workspace;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    public $workspace ;

    public function mount(Request $request)
    {

        $this->workspace = $this->currentWorkspace($request->route('workspace'));
        // dd($this->workspace);
    }
    public function render()
    {
        return view('livewire.workspace.index');
    }

    protected function currentWorkspace($name)
    {
        return Workspace::where('name',$name)->with('users')->first();
    }
}
