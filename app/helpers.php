<?php

use Illuminate\Support\Facades\Storage;


if(!function_exists('getLogo'))
{
    function getLogo()
    {
        $path = config('photofilepath.logo_filepath');
        $photo =  asset('asset/logo.jpeg');
        return $photo;
    }
}

if(!function_exists('storageCreate'))
{
    function storageCreate(string $folder)
    {
        $path = 'images/data/' . $folder;
        Storage::makeDirectory($path,0777,true);
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path,0777,true);
        }
        return $path;
    }
}

if(!function_exists('getProfilePhoto'))
{
    function getProfilePhoto($photo)
    {
        $image_path = 'images/data/profile/';
            if(strval($photo) == ''){
                return "error";
            }
            if(!Storage::disk('local')->exists('public/'.$image_path . $photo)){
                return $image_path . $photo;
                // return $this->imageSrc;
            }
            $imageSrc ='data:image/jpeg;base64,' . base64_encode(Storage::disk('local')->get('public/'.$image_path . $photo));
            // $imageSrc = Storage::url($image_path . $photo);
            return $imageSrc;

    }
}
