<?php

namespace App\Http\Livewire\Issues\Tags;

use App\Models\Status;
use App\Services\IssueInfoHelper;
use Livewire\Component;

class StatusIndex extends Component
{
    public $statues ;
    public $currentStatus ;

    public function mount($currentStatus)
    {
        $this->statues = IssueInfoHelper::getStatuses();
        $this->currentStatus =  $currentStatus ?? [];
    }

    public function render()
    {
        return view('livewire.issues.tags.status-index');
    }

    public function changeStatus($id)
    {
        $this->currentStatus = $this->statues->find($id) ?? $this->statuses->first();
        $this->emit('changeStatus', $this->currentStatus);
    }
}
