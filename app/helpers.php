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
