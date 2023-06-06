<?php

namespace App\View\Components\profile;

use Illuminate\View\Component;

class WorkspacePhoto extends Component
{
  
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($workspace)
    {
    }

   

    public function render()
    {
        return view('components.profile.workspace-photo');
    }
}
