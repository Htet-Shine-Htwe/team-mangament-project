<?php

namespace App\View\Components\profile;

use Illuminate\View\Component;

class WorkspacePhoto extends Component
{
    public string $photo;
    public string $workspaceName;

    public string $haxColor;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($workspace)
    {
        $this->photo = $this->outputPhoto($workspace?->logo_path);
        $this->workspaceName = $this->makeWorkspaceLogo($workspace?->name);
        $this->haxColor = $this->fakeColor();
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

    public function render()
    {
        return view('components.profile.workspace-photo');
    }
}
