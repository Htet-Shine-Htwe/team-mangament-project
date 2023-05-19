<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputComponent extends Component
{
    public string $name;
    public string $id;
    public string $input;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name,string $id,string $input="user")
    {
        $this->name = $name;
        $this->id = $id;
        $this->input = $input;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-component');
    }
}
