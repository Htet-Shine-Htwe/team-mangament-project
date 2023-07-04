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

    public $issues = [];

    public $statuses;
    public $currentWorkspaceId;

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
            $status->issues = $this->getIssuesByStatus($status->id,5);

            $issues[] = $status;

        });

        return $issues;
    }

    protected function getIssuesByStatus(?int $id,int $amount = 10 )
    {
        return Issue::query()
        ->select('id', 'title', 'status_id', 'creator_id', 'assign_id', 'created_at')
        ->where('status_id', $id)
        ->where('workspace_id', $this->currentWorkspaceId)
        ->orderBy('created_at', 'desc')
        ->limit($amount)
        ->get()
        ;
    }

    public function loadMore( $name,$id)
    {
        // dd($name,(int) $id);
        foreach($this->issues as &$issue)
        {
            if($issue['title'] === $name){
                $issue['issues'] = $this->getIssuesByStatus((int) $id, 10);
            }
            // dd($issue);
        }
        // dd($this->issues);
        // $this->issues[$name]['issues'] =
    }

}
