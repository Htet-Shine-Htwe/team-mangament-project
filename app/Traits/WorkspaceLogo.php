<?php

namespace App\Traits;

use App\Models\Workspace;
use App\Services\WorkspaceHelper;
use App\Storage\S3FileStorage;
use Illuminate\Support\Facades\Session;

trait WorkspaceLogo
{
    public function getWorkspaceName()
    {
        return  makeWorkspaceLogo($this->workspace->name);
    }

    public function getWorkspaceLogo()
    {
        return $this->storage->getPhoto($this->workspace->logo_path,'workspaceLogo');
    }
}
