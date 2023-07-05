<?php

namespace App\Http\Livewire\Issues\Search;

use App\Models\Issue;
use App\Services\WorkspaceHelper;
use Livewire\Component;

class Index extends Component
{
    public $search ;
    public $issues = [];

    public function mount()
    {

    }

    public function updatedSearch()
    {
        sleep(1);
        if($this->search != ''){
            $this->issues = Issue::where('title','like','%'.$this->search.'%')
            ->where('workspace_id',WorkspaceHelper::getCurrentWorkspace()->id)
            ->with('status:id,color')
            ->limit(20)
            ->get()->toArray();
        }
        elseif($this->search == '')
        {
            $this->issues = [];
        }

    }

    public function render()
    {
        return view('livewire.issues.search.index');
    }
}
