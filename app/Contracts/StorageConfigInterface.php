<?php

namespace App\Contracts;

interface StorageConfigInterface
{
    public function getPhoto(mixed $photo,string $image_type);

    public function  storePhotos($photos,string $folder);
}
