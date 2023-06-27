<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use App\Models\Status;
use App\Services\IssueCreateService;
use App\Services\WorkspaceHelper;
use Livewire\Component;

class Index extends Component
{
    public $title;

    public $description ;

    public $status ;

    public $assign;

    public $currentWorkspace;

    public $draftData ;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'status' => 'required',
    ];

    public function mount()
    {
        $this->currentWorkspace = WorkspaceHelper::getCurrentWorkspace();
        $this->status = Status::select('id','title','color')->first();
        $this->assign = $this->currentWorkspace->users->first();
        if(empty(!$data = $this->getDraftData())){
            $this->title = $data['title'];
            $this->description = $data['description'];
            $this->status = $data['status'];
            $this->assign = $data['assign'];
        }

    }

    public function render()
    {
        return view('livewire.issues.index');
    }

    public function createIssue(){
        $this->validate();

        $data = $this->only(['title','description','assign','status','currentWorkspace']);
        $issue = IssueCreateService::create($data);

        dd($issue);
    }

    protected function getDraftData()
    {
       return session()->get('old_issue_create') ?? [];
    }
}
