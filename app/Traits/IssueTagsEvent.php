<?php

namespace App\Traits;

trait IssueTagsEvent
{
    public function changeStatus($status)
    {
        $this->status = $status;
    }

    public function changeAssign($assign)
    {
        $this->assign = $assign;
    }
    public function changeDueDate($dueDate)
    {

        $this->due_date = $dueDate;
    }
}
