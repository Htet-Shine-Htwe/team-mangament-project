<?php

namespace App\Http\Livewire\Issues\Model;

use App\Models\Issue;
use App\Models\Status;
use App\Services\WorkspaceHelper;
use Livewire\Component;

class Index extends Component
{
    public $title;

    public $description ;

    public $status ;

    public $currentWorkspace;

    public $listeners = ['changeStatus'];

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'status' => 'required',
    ];

    public function mount()
    {
        $this->currentWorkspace = WorkspaceHelper::getCurrentWorkspace();
        $this->status = Status::select('id','title','color')->first()->toArray();
    }

    public function render()
    {
        return view('livewire.issues.model.index');
    }

    public function submit()
    {
        $this->validate();

        Issue::create([
            'title' => $this->title,
            'description' => $this->description,
            'status_id' => $this->status,
            'workspace_id' => $this->currentWorkspace->id,
            'creator_id' => auth()->id(),
        ]);
    }

    public function changeStatus($status)
    {
        $this->status = $status;
    }
}
