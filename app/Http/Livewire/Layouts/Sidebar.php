<?php

namespace App\Http\Livewire\Layouts;

use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Sidebar extends Component
{
    public $workspaces;
    public $currentWorkspace ;

    public string $photo;
    public string $workspaceName;

    public string $haxColor;

    public function mount()
    {
        $this->workspaces = Auth::user()->workspaces;
        $this->currentWorkspace =  Session::get('selected_workspace') ?? Auth::user()->workspaces[0];

        $this->photo = $this->outputPhoto($this->currentWorkspace?->logo_path);
        $this->workspaceName = $this->makeWorkspaceLogo($this->currentWorkspace?->name);
        $this->haxColor = $this->fakeColor();
    
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

    protected function makeWorkspaceLogo(?string $workspaceName)
    {
        $words = explode(" ", $workspaceName); // Split the string into an array of words

        $logoWords = '';
        $maxLoop = count($words) < 4 ? count($words) : 3;

        for($i = 0;$i < $maxLoop ;$i++)
        {
            $ucLetter = strtoupper(substr($words[$i], 0, 1)); // Get the first letter of each word and convert it to uppercase
            $logoWords .= $ucLetter; // Concatenate the first letters
        }
        // dd($logoWords);

        return $logoWords;

    }

    protected function fakeColor()
    {
        return fake()->safeHexColor();
    }

}
