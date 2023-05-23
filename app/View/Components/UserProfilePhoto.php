<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserProfilePhoto extends Component
{
    public $user;
    public $photo;

    public $status;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user,$status=false)
    {
        $this->user= $user;
        $this->status = $status;
        $this->photo = $this->getPhoto($this->user);
    }

    protected function getPhoto($user)
    {
        if($user->profile_photo_path == null && $user->avatar == null)
        {
            $photo =  getProfilePhoto($user->profile_photo_path) ;
        }
        elseif($user->profile_photo_path == null)
        {
            $photo = $user->avatar ;
        }
        else
        {
            $photo =  getProfilePhoto($user->profile_photo_path) ;
        }
       return $photo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-profile-photo');
    }
}
