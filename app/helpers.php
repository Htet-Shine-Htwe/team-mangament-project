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

if (!function_exists('getWorkshopPhoto'))
{
    function getWorkshopPhoto($photo,$provider) :string
    {
        $image_path = config('photofilepath.workspace_logoPath');

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
if (!function_exists('niceTitle'))
{
    function niceTitle($text)
    {
        return ucwords(Str::words($text  ,3 ,'....'));
    }
}


//make logoName from workspace name
if (!function_exists('makeWorkspaceLogo'))
{
    function makeWorkspaceLogo(string $workspaceName)
    {
        $words = explode(" ", $workspaceName); // Split the string into an array of words

        $logoWords = '';
        $maxLoop = count($words) < 4 ? count($words) : 3;

        for($i = 0;$i < $maxLoop ;$i++)
        {
            $ucLetter = strtoupper(substr($words[$i], 0, 1)); // Get the first letter of each word and convert it to uppercase
            $logoWords .= $ucLetter; // Concatenate the first letters
        }
        // dd($logoWords);

        return $logoWords;

    }
}

