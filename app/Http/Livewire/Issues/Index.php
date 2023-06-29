<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use App\Models\Status;
use App\Services\IssueCreateService;
use App\Services\IssueInfoHelper;
use App\Services\WorkspaceHelper;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{

    public function render()
    {
        return view('livewire.issues.index');
    }

}
