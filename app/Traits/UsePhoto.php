<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait UsePhoto
{

    protected string $profileImagePath ;

    protected string $imageSrc  = 'dummy.jpeg';

    public function getProfileImage()
    {
        $this->profileImagePath = config('photofilepath.profile_photo_filepath');
    }

    protected function setImagesPath()
    {
        $this->getProfileImage();
    }

    public function getPhoto(mixed $photo = '',string $image_type){
        $image_path = $image_type . 'ImagePath';

        $this->setImagesPath();

        if (property_exists($this, $image_path)) {

            if(strval($photo) == ''){
                return $this->imageSrc;
            }
            if(!Storage::disk('local')->exists('public/'.$this->{$image_path} . $photo)){
                return $this->{$image_path} . $photo;
                // return $this->imageSrc;
            }
            $imageSrc ='data:image/jpeg;base64,' . base64_encode(Storage::disk('local')->get('public/'.$this->{$image_path} . $photo));
            // $imageSrc = Storage::url($this->{$image_path} . $photo);
            return $imageSrc;
        }

        throw new \Exception("Invalid image type: $image_type");

    }

    public function storePhotos(mixed $photos,string $folder)
    {
        $path = 'public/images/data/' .$folder;
        if(is_array($photos))
        {
            $nameCollection = [];
            foreach($photos as $key => $photo){
                $photoName = "photoImage".uniqid().'.'.$photo->getClientOriginalExtension();
                $nameCollection[$key] = $photoName;
                $photo->storeAs($path,$photoName);
            }
            return $nameCollection;
        }

        $photoName = "photoImage".uniqid().'.'.$photos->getClientOriginalExtension();

        $photos->storeAs($path,$photoName);
        return $photoName;
    }
}
