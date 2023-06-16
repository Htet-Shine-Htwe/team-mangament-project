<?php

namespace App\Services;

use App\Models\Workspace;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WorkspaceHelper
{
    private static $currentWorkspace = null;
    private static $userWorkspaces = null;

    /**
     * Method to return current workpsace
     *
     * @return Workspace
     */
    public static function getCurrentWorkspace() :Workspace
    {
        if (self::$currentWorkspace === null) {
            self::$currentWorkspace = self::retrieveCurrentWorkspace();
        }

        return self::$currentWorkspace;
    }

    /**
     * Method to get the workspaces of the current user
     *
     * @return Collection
     */
    public static function getUserWorkspaces() :Collection
    {
        if (self::$userWorkspaces === null) {
            self::$userWorkspaces = Auth::user()->workspaces()->get();
        }

        return self::$userWorkspaces;
    }

    private static function retrieveCurrentWorkspace() :Workspace|null
    {
        $workspace = getCurrentWorkspace(Session::get('selected_workspace') ?? self::$userWorkspaces->first()->id);
        return $workspace;
    }

    //make sure the user has access to the workspace
    public static function checkUserHasAccessToWorkspace(int $workspaceId) :bool
    {
        $userWorkspaces = self::getUserWorkspaces();

        if (!$userWorkspaces->pluck('id')->contains($workspaceId)) {
            return false;
        }

        return true;
    }

}
