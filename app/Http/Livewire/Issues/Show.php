<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use App\Models\Status;
use App\Services\IssueCreateService;
use App\Services\IssueInfoHelper;
use App\Services\WorkspaceHelper;
use App\Traits\IssueTagsEvent;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads,IssueTagsEvent;
    public $title;

    public $description ;

    public $status ;

    public $assign;

    public $currentWorkspace;

    public $due_date;

    public $fileUpload;

    public $sessionPhotos;
    public $draftData ;


    public $listeners = ['changeStatus','changeAssign','changeDueDate'];



    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'status' => 'required',
        // 'fileUpload'  => 'nullable|file|mimes:png,jpg,max:3072'
    ];

    public function mount()
    {
        $this->currentWorkspace = WorkspaceHelper::getCurrentWorkspace();
        $this->status = IssueInfoHelper::getStatuses();
        $this->assign = current(WorkspaceHelper::getCurrentWorkspaceUsers());
        // dd($this->getDraftData());
        if(empty(!$data = $this->getDraftData())){
            $this->title = $data['title'];
            $this->description = $data['description'];
            $this->status = $data['status'];
            $this->assign = $data['assign'];
            $this->due_date = $data['due_date'];
            if(isset($data['fileUpload']))
            {
                $files = $data['fileUpload'];
                $this->sessionPhotos = $files;
                forEach($files as $file)
                {
                    $this->fileUpload[] = asset($file);
                }
            }
        }

    }

    public function render()
    {
        return view('livewire.issues.show');
    }

    public function createIssue(){
        $this->validate();
        $data = $this->only(['title','description','assign','status','currentWorkspace','due_date']);
        $issue = IssueCreateService::create($data,$this->fileUpload);

        dd($issue);
    }

    protected function getDraftData()
    {
       return session()->get('old_issue_create') ?? [];
    }


}
