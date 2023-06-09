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
        if(!is_array($user))
        {
            $this->user = $user->toArray();
        }
        $this->user  = $user;


        $this->photo = $this->getPhoto($this->user);
    }

    protected function getPhoto($user)
    {

        if($user['profile_photo_path'] == null && $user['avatar'] == null)
        {
            $photo =  getPhoto($user['profile_photo_path'],'profilePhoto') ;
        }
        elseif($user['profile_photo_path'] == null)
        {
            $photo = $user['avatar'];
        }
        else
        {
            $photo =  getPhoto($user['profile_photo_path'],'profilePhoto') ;
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
