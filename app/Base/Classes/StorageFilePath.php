<?php

namespace App\Base\Classes;

class StorageFilePath
{
    protected string $profileImagePath;

    protected string $workspaceLogoImagePath;
    protected string $imageSrc = 'empty' ;

    public function getImagesPath()
    {
        $this->profileImagePath = config('photofilepath.profile_photo_filepath');
        $this->workspaceLogoImagePath = config('photofilepath.workspace_logoPath');
    }

    protected function setImagesPath()
    {
        $this->getImagesPath();
    }
}
