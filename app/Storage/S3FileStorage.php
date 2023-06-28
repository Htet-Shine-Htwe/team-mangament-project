<?php

namespace App\Storage;
use App\Base\Classes\StorageFilePath;
use App\Contracts\StorageConfigInterface;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class S3FileStorage extends StorageFilePath implements StorageConfigInterface
{

    public function getPhoto(mixed $photo,string $image_type) :String
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

    public function  storePhotos($photos,string $folder='') :String|array
    {
       $path = storageCreate($folder);
       if(is_array($photos))
       {
           $nameCollection = [];
           foreach($photos as $key => $photo){
               $photoName = "photoImage".uniqid().'.'.$photo->getClientOriginalExtension();
               $nameCollection[$key] = $photoName;
               $resizedPhoto = $this->resizePhoto($photo);
                Storage::disk('s3')->put($path.'/' . $photoName, (string) $resizedPhoto->encode());


           }
           return $nameCollection;
       }
    //    $photoName = "photoImage" . uniqid() . '.' . pathinfo($photos->getClientOriginalName(), PATHINFO_EXTENSION);
    //    $photos->storeAs($path,$photoName,'s3');

        $photoName = "photoImage".uniqid().'.jpg';
        $resizedPhoto = $this->resizePhoto($photos);

        Storage::disk('s3')->put($path.'/' . $photoName, (string) $resizedPhoto->encode());

       return $photoName;
    }

    protected function resizePhoto($photo)
    {
        $img = Image::make($photo);;
        $size = $img->filesize();

        if($size > 1000000)
        {
            $img->encode('jpg',80);
            $img->resize(400, 200);
        }
        return $img->fit(200, 200);
    }



}
