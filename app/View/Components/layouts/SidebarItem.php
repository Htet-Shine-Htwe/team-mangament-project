<?php

namespace App\View\Components\layouts;

use App\Models\Workspace;
use Illuminate\View\Component;

class SidebarItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $name="null",public string $iconClass="no",public string $route="dashboard",public Workspace $currentWorkspace)
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
        return view('components.layouts.sidebar-item');
    }
}
