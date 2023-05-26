<?php

namespace App\Base\Classes;

class StorageFilePath
{
    protected string $profileImagePath;

    protected string $imageSrc = 'dummy.jpeg';

    public function getProfileImage()
    {
        $this->profileImagePath = config('photofilepath.profile_photo_filepath');
    }

    protected function setImagesPath()
    {
        $this->getProfileImage();
    }
}
