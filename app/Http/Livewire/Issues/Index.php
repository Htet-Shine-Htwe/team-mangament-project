<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use App\Models\Status;
use App\Services\IssueCreateService;
use App\Services\IssueInfoHelper;
use App\Services\WorkspaceHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{

    public $issues = [];

    public $statuses;
    public $currentWorkspaceId;

    protected $listeners = ['refreshIssues'];
    public function dehydrate()
{
    $this->dispatchBrowserEvent('initSomething');
}
    public function mount()
    {
        $this->currentWorkspaceId = WorkspaceHelper::getCurrentWorkspace()->id;
        $this->statuses = IssueInfoHelper::getStatuses();
        $this->issues =  $this->getIssues();
        // dd($this->issues);
    }
    public function render()
    {
        return view('livewire.issues.index');
    }

    protected function getIssues()
    {
        $issues = [];

        $this->statuses->each(function ($status) use (&$issues) {
            $status->issue_count =DB::table('issues')
            ->selectRaw('count(*) as count')
            ->where('status_id', $status->id)
            ->value('count');

            $name = 'status-'.$status->title;
            $status->issues = $this->cacheIssue($name,$this->getIssuesByStatus($status->id, 10));
            $issues[] = $status;

        });

        return $issues;
    }

    protected function getIssuesByStatus(?int $id,int $amount = 10 )
    {
        return Issue::
        select('id', 'title', 'status_id', 'creator_id', 'assign_id', 'created_at')
        ->where('status_id', $id)
        ->where('workspace_id', $this->currentWorkspaceId)
        ->orderBy('created_at', 'desc')
        ->limit($amount)
        ->get()
        ;
    }

    public function loadMore( $name,$id)
    {
        foreach($this->issues as &$issue)
        {
            if($issue['title'] === $name){
                $total = count($issue['issues']) + 10;
                $name = 'status-'.$issue['title'];
                $issue['issues'] = $this->cacheIssue($name,$this->getIssuesByStatus((int) $id, $total));
            }
            // dd($issue);
        }
    }

    public function refreshIssues()
    {
        $this->issues =  $this->getIssues();
    }


    protected function cacheIssue($name,$callback)
    {
        return Cache::remember($name,60,function() use ($callback){
            return $callback;
        });
    }
}
