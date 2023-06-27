<?php

namespace App\Http\Livewire\Issues\Model;

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

        $data = $this->only(['title','description','assign','status','currentWorkspace']);
        $issue = IssueCreateService::create($data);

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

    public function fullScreen(){
        session()->put('old_issue_create',[
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'assign' => $this->assign,
        ]);
        return redirect()->route('workspace.issue.create',['workspace_name' => getCurrentWorkspaceName()]);
    }
}
