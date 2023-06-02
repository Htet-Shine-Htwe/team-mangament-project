<?php

use App\Models\Workspace;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


if (!function_exists('getLogo'))
{
    function getLogo() :string
    {
        $path = config('photofilepath.logo_filepath');
        $photo = asset('asset/logoIcon.png');
        return $photo;
    }
}
if (!function_exists('getSpinner'))
{
    function getSpinner() :string
    {
        $path = config('photofilepath.logo_filepath');
        $photo = asset('asset/spinner.png');
        return $photo;
    }
}

if (!function_exists('storageCreate'))
{
    function storageCreate(string $folder) :string
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

if (!function_exists('getProfilePhoto'))
{
    function getProfilePhoto($photo,$provider) :string
    {
        $image_path = config('photofilepath.profile_photo_filepath');

        if (Storage::disk($provider)->exists($image_path . $photo) && $photo != null)
        {
            $imageSrc = 'data:image/jpeg;base64,' . base64_encode(Storage::disk($provider)->get($image_path . $photo));
            return $imageSrc;
        }
        $imageSrc = getLogo();
        return $imageSrc;

    }
}

if (!function_exists('getEmojis'))
{
    function getEmojis($limit)
    {

            $response = Http::get('https://unpkg.com/emoji.json/emoji.json');

            if ($response->ok())
            {
                $emojis = $response->json();
                $emojis = array_slice($emojis, 0, $limit);

                return $emojis;
            }

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
if (!function_exists('currentWorkspace'))
{
    function currentWorkspace($name)
    {
        $request->route('workspace');
        return Workspace::where('name',$name)->with('users')->first();
    }
}


