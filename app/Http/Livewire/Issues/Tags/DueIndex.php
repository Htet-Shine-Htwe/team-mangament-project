<?php

namespace App\Http\Livewire\Issues\Tags;

use Carbon\Carbon;
use Livewire\Component;

class DueIndex extends Component
{
    public $due_date;

    public $index;
    public $listeners = ['changeDueDate'];

    public function mount(?int $index, $due_date = null)
    {
        $this->index = $index ?? 1;
        $this->due_date = $due_date;
    }
    public function render()
    {
        return view('livewire.issues.tags.due-index');
    }

    public function changeDueDate($dueDate)
    {
        $this->due_date = $dueDate;
    }

    public function setDueDateTmr()
    {
        $this->due_date = now()->addDay()->format('d/m/Y');
        $this->emit('changeDueDate', $this->due_date);
    }

    public function setDueDateNextWeek()
    {
        $this->due_date = now()->addWeek()->format('d/m/Y');
        $this->emit('changeDueDate', $this->due_date);
    }

    public function removeDueDate()
    {
        $this->due_date = null;
        $this->emit('changeDueDate', $this->due_date);
    }

}
