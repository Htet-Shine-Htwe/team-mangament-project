<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WorkspaceHelper
{
    private static $currentWorkspace = null;
    private static $userWorkspaces = null;

    public static function getCurrentWorkspace()
    {
        if (self::$currentWorkspace === null) {
            self::$currentWorkspace = self::retrieveCurrentWorkspace();
        }

        return self::$currentWorkspace;
    }

    public static function getUserWorkspaces()
    {
        if (self::$userWorkspaces === null) {
            self::$userWorkspaces = Auth::user()->workspaces()->get();
        }

        return self::$userWorkspaces;
    }

    private static function retrieveCurrentWorkspace()
    {
        $workspace = getCurrentWorkspace(Session::get('selected_workspace'));
        return $workspace;
    }

    //make sure the user has access to the workspace
    public static function checkUserHasAccessToWorkspace(int $workspaceId)
    {
        $userWorkspaces = self::getUserWorkspaces();

        if (!$userWorkspaces->pluck('id')->contains($workspaceId)) {
            return false;
        }

        return true;
    }

}
