<?php

use App\Enums\RoleStatus;
use App\Models\Workspace;
use App\Services\WorkspaceHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


if (!function_exists('getLogo'))
{
    function getLogo(): string
    {
        $path = config('photofilepath.logo_filepath');
        $photo = asset('asset/logoIcon.png');
        return $photo;
    }
}
if (!function_exists('getSpinner'))
{
    function getSpinner(): string
    {
        $path = config('photofilepath.logo_filepath');
        $photo = asset('asset/spinner.png');
        return $photo;
    }
}

if (!function_exists('storageCreate'))
{
    function storageCreate(string $folder): string
    {
        $path = 'public/images/' . $folder;
        Storage::makeDirectory($path, 0777, true);
        if (!Storage::exists($path))
        {
            Storage::makeDirectory($path, 0777, true);
        }
        return $path;
    }
}


if (!function_exists('getPhoto'))
{
    function getPhoto($photo, $configKey, $defaultImage = null): string
    {
        $provider = app('storageProvider');
        $imagePath = config('photofilepath.' . $configKey);

        try
        {

            if (Storage::disk($provider)->exists($imagePath . $photo) && $photo !== null)
            {
                $imageSrc = 'data:image/jpeg;base64,' . base64_encode(Storage::disk($provider)->get($imagePath . $photo));
                return $imageSrc;
            }
        }
        catch (\Exception $e)
        {
            return $imageSrc = "failed to load image";
        }

        // If the photo doesn't exist, return the default image
        if ($defaultImage !== null)
        {
            return $defaultImage;
        }

        // Fallback to getLogo() if no default image provided
        return getLogo();
    }
}

if (!function_exists('getEmojis'))
{
    function getEmojis($limit): array
    {

        $response = Http::get('https://unpkg.com/emoji.json/emoji.json');

        if ($response->ok())
        {
            $emojis = $response->json();
            $emojis = array_slice($emojis, 0, $limit);

            return $emojis;
        }

        return [];
    }
}

if (!function_exists('checkOnline'))
{
    function checkOnline($user): bool
    {
        if (Cache::has('user-online' . $user->id))
        {
            return true;
        }
        return false;
    }
}
if (!function_exists('niceTitle'))
{
    function niceTitle($text): string
    {
        return ucwords(Str::words($text, 3, '....'));
    }
}


//make logoName from workspace name
if (!function_exists('makeWorkspaceLogo'))
{
    function makeWorkspaceLogo(string $workspaceName): string
    {
        $words = explode(" ", $workspaceName); // Split the string into an array of words

        $logoWords = '';
        $maxLoop = count($words) < 4 ? count($words) : 3;

        for ($i = 0; $i < $maxLoop; $i++)
        {
            $ucLetter = strtoupper(substr($words[$i], 0, 1)); // Get the first letter of each word and convert it to uppercase
            $logoWords .= $ucLetter; // Concatenate the first letters
        }
        // dd($logoWords);

        return $logoWords;

    }
}

if (!function_exists('getCurrentWorkspace'))
{
    function getCurrentWorkspace(?int $workspaceId): Workspace
    {
        $workspace = Workspace::with('users')->find($workspaceId);

        if (!$workspace)
        {
            session()->forget('selected_workspace');
            $workspace = Auth::user()->workspaces()->first();
        }

        return $workspace;
    }
}
if (!function_exists('getInvitationId'))
{
    function getInvitationId(string $url): string
    {
        if (Str::contains($url, 'invitations'))
        {
            $sliceUrl = Str::after($url, 'invitations/');
            $id = Str::before($sliceUrl, '?');
            return $id;
        }
        return $url;
    }
}

if (!function_exists('checkWorkspaceAdmin'))
{
    function checkWorkspaceAdmin()
    {
        $workspace = WorkspaceHelper::getCurrentWorkspace()->id ?? session()->get('selected_workspace');

        $userRole = DB::table('user_workspace')
        ->select('roles.name')
        ->where('user_id', auth()->id())
        ->where('workspace_id', $workspace)
        ->join('roles', 'user_workspace.role_id', '=', 'roles.id')
        ->first();

        if ($userRole->name == RoleStatus::ADMIN->value)
        {
            return true;
        }
        return false;
    }

    function getCurrentWorkspaceName()
    {
        return WorkspaceHelper::getCurrentWorkspace()->name ?? 'null';
    }
}
