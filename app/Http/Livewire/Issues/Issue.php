<?php

namespace App\Http\Livewire\Issues;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Issue as IssueModel;
class Issue extends Component
{
    public $issue;

    public function mount($slug)
    {
        $title = str_replace('-',' ',$slug);
        $this->issue = IssueModel::where('title',$title)->first();
        if(!$this->issue)
        {
            return abort(404,'Issue not found');
        }
    }

    public function render()
    {
        return view('livewire.issues.issue');
    }
}
