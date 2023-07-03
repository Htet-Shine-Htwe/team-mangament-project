<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use App\Models\Status;
use App\Services\IssueCreateService;
use App\Services\IssueInfoHelper;
use App\Services\WorkspaceHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{

    public $issues;


    public function mount()
    {
        $currentWorkspaceId = WorkspaceHelper::getCurrentWorkspace()->id;
        $this->issues =  Status::select('id','title','color')
        ->with(['issues' => function($query) use ($currentWorkspaceId){
            $query->select('id','title','description','status_id','creator_id','assign_id','due_date','created_at')
            ->where('workspace_id',$currentWorkspaceId)
            ->with('user:id,name,avatar,profile_photo_path,email');

        }])
        ->get();

        // var_dump($this->issues);

        //
        // ->get();
    }
    public function render()
    {
        return view('livewire.issues.index');
    }

}
