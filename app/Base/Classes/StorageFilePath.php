<?php

namespace App\Base\Classes;

class StorageFilePath
{
    protected string $profileImagePath;

    protected string $workspaceLogoImagePath;
    protected string $imageSrc = 'empty' ;

    public function getImagesPath()
    {
        $this->profileImagePath = config('photofilepath.profilePhoto');
        $this->workspaceLogoImagePath = config('photofilepath.workspaceLogo');
    }

    protected function setImagesPath()
    {
        $this->getImagesPath();
    }
}
