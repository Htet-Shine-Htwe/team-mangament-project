<?php

namespace App\Storage;
use App\Base\Classes\StorageFilePath;
use App\Contracts\StorageConfigInterface;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Storage;

class S3FileStorage extends StorageFilePath implements StorageConfigInterface
{

    public function getPhoto(mixed $photo,string $image_type)
    {
        $image_path = $image_type . 'ImagePath';

        $this->setImagesPath();

        if (property_exists($this, $image_path))
        {

            if (strval($photo) == '')
            {
                return $this->imageSrc;
            }
            if (!Storage::disk('s3')->exists($this->{$image_path} . $photo))
            {
                return $this->{$image_path} . $photo;
            }
            $imageSrc = 'data:image/jpeg;base64,' . base64_encode(Storage::disk('s3')->get($this->{$image_path} . $photo));
            return $imageSrc;
        }

        throw new \Exception("Invalid image type: $image_type");
    }

    public function  storePhotos(mixed $photos='',string $folder='')
    {
       $path = storageCreate('profile');

       if(is_array($photos))
       {
           $nameCollection = [];
           foreach($photos as $key => $photo){
               $photoName = "photoImage".uniqid().'.'.$photo->getClientOriginalExtension();
               $nameCollection[$key] = $photoName;
               $photo->storeAs($path,$photoName,'s3');

           }
           return $nameCollection;
       }

       $photoName = "photoImage".uniqid().'.'.$photos->getClientOriginalExtension();
       $photos->storeAs($path,$photoName,'s3');

       return $photoName;
    }



}
