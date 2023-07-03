<?php

namespace App\Services;

use App\Models\Workspace;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class WorkspaceHelper
{
    private static $currentWorkspace = null;
    private static $userWorkspaces = null;

    private static $currentWorkspaceUsers = null;

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
            self::$userWorkspaces = Cache::remember('authWorkspaces', 120, function () {
               return Auth::user()->workspaces()->get();
            });
        }

        return self::$userWorkspaces;
    }

    // Method to get the users of the current workspace
    private static function retrieveCurrentWorkspace() :Workspace|null
    {
        $workspace = getCurrentWorkspace(Session::get('selected_workspace') ?? null);
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

    //get the users of the current workspace
    public static function getCurrentWorkspaceUsers()
    {
        if (self::$currentWorkspaceUsers === null) {
            self::$currentWorkspaceUsers = self::getCurrentWorkspace()
            ->users()
            ->select('users.id','name','email','profile_photo_path','avatar')
            ->get()
            ->keyBy('id')
            ->toArray();
        }

        return self::$currentWorkspaceUsers;
    }

}
