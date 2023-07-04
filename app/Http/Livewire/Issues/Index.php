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
            $query->select('id','title','status_id','creator_id','assign_id','created_at')
            ->where('workspace_id',$currentWorkspaceId)
            ->with('user:id,name,avatar,profile_photo_path,email')
            ->orderBy("created_at",'desc')
            ->limit(10)
            ;

        }])

        ->withCount(['issues' => function($query) use ($currentWorkspaceId){
            $query->where('workspace_id',$currentWorkspaceId);
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
