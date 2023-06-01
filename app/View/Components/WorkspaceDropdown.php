<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class WorkspaceDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.workspace-dropdown');
    }

    public function selectWorkspace(Request $request)
    {
        $workspaceId = $request->input('workspace_id');
        $request->session()->put('selected_workspace', $workspaceId);
    }
}
