<?php

namespace App\Services;

use App\Models\Issue;

class IssueCreateService
{
    public static function create($data)
    {
        return Issue::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status_id' => $data['status']['id'],
            'assign_id' => $data['assign']['id'],
            'workspace_id' => $data['currentWorkspace']['id'],
            'creator_id' => auth()->id(),
        ]);
    }
}
