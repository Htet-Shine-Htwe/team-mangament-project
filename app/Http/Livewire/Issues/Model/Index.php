<?php

namespace App\Http\Livewire\Issues\Model;

use App\Models\Issue;
use App\Models\Status;
use App\Services\IssueCreateService;
use App\Services\IssueInfoHelper;
use App\Services\WorkspaceHelper;
use App\Traits\CacheModify;
use App\Traits\IssueTagsEvent;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads,IssueTagsEvent,CacheModify;
    public $title;

    public $description ;

    public $status ;

    public $assign;

    public $due_date;
    public $currentWorkspace;

    public $fileUpload;

    public $listeners = ['changeStatus','changeAssign','changeDueDate'];

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'status' => 'required',
        'fileUpload'  => 'nullable|file|mimes:png,jpg,max:3072,count:3'

    ];


    public function mount()
    {
        $this->currentWorkspace = WorkspaceHelper::getCurrentWorkspace();
        $this->status = IssueInfoHelper::getStatuses()->first()->toArray();
        $this->assign = current(WorkspaceHelper::getCurrentWorkspaceUsers()) ?? [];
    }//

    public function render()
    {
        return view('livewire.issues.model.index');
    }

    public function submit()
    {
        $this->validate();

        $data = $this->only(['title','description','assign','status','currentWorkspace','due_date']);
        IssueCreateService::create($data);

        $this->clearCache($this->currentWorkspace->id,$this->status['title'],'status');

        $this->emit('refreshIssues');

        $this->reset(['title','description','due_date','fileUpload']);

    }

    public function fullScreen(){

        $sessionImages = [];
        if(! empty($this->fileUpload))
        {

            $path = storageCreate('session_photo') . '/';
            forEach($this->fileUpload as $file)
            {
                $photoName = "photoImage".uniqid().'.'.$file->getClientOriginalExtension();
                $file->storeAs($path,$photoName,'local');
                $sessionImages[] = Storage::url($path.$photoName);

            }
        }
        // dd($sessionImages);
        session()->put('old_issue_create',[
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'assign' => $this->assign,
            'due_date' => $this->due_date,
            'fileUpload' => $sessionImages,
        ]);
        return redirect()->route('workspace.issue.create',['workspace_name' => getCurrentWorkspaceName()]);
    }
}
