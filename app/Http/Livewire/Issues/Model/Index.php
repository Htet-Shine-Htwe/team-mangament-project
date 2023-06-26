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

    public $assign;
    public $currentWorkspace;

    public $listeners = ['changeStatus','changeAssign'];

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'status' => 'required',
    ];

    public function mount()
    {
        $this->currentWorkspace = WorkspaceHelper::getCurrentWorkspace();
        $this->status = Status::select('id','title','color')->first()->toArray();
        $this->assign = $this->currentWorkspace->users->first()->toArray() ?? [];
    }

    public function render()
    {
        return view('livewire.issues.model.index');
    }

    public function submit()
    {
        // dd('clicked');
        $this->validate();

        $issue = Issue::create([
            'title' => $this->title,
            'description' => $this->description,
            'status_id' => $this->status['id'],
            'assign_id' => $this->assign['id'],
            'workspace_id' => $this->currentWorkspace->id,
            'creator_id' => auth()->id(),
        ]);

        dd($issue);
    }

    public function changeStatus($status)
    {
        $this->status = $status;
    }

    public function changeAssign($assign)
    {
        $this->assign = $assign;
    }
}
