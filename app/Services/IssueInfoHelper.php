<?php

namespace App\Services;

use App\Models\Status;
use App\Models\UserWorkspace;

class IssueInfoHelper
{
    protected static $users;

    protected static $statues =null;

    public static function getUsers()
    {
        // $workspace = WorkspaceHelper::getCurrentWorkspace();
        // $this->users = $workspace->users;
        self::$users =  WorkspaceHelper::getCurrentWorkspaceUsers();
    }

    public static function getAssign()
    {
        self::getUsers();
        return self::$users;
    }

    public static function getStatuses()
    {
        if(self::$statues == null)
        {
            self::$statues = Status::select('id','title','color')->get();
        }
       return  self::$statues ;
    }
}
