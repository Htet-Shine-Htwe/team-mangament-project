<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Services\ProfileUpdateService;
use App\Traits\UsePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class Show extends Component
{
    use UsePhoto, WithFileUploads;
    public $user;
    public $user_name;
    public $loadedEmojis = 200;
    public $profile_photo;
    public $tmp_photo;
    public $confirm_user_name;
    public $emojis;
    public $selectedEmoji;
    public $status = "";

    public $bio = "";


    public function mount(Request $request, ProfileUpdateService $profileUpdateService)
    {
        $this->user = $request->user();
        if (!$this->user == null)
        {
            $this->user_name = $this->user->name;
            $this->profile_photo = $this->user->profile_photo_path;
            $this->profile_photo = $this->getPhoto($this->profile_photo, 'profile');
            $this->status = $this->user->status;
            $this->selectedEmoji = $this->user->status_emoji !== null ? $this->user->status_emoji  : '1F600';
            $this->bio = $this->user->bio;
        }
        $this->emojis = getEmojis($this->loadedEmojis);
        // dd($this->emojis);
    }

    public function render()
    {
        return view('livewire.profile.show');
    }

    public function updateProfile()
    {
        $updated_user = User::where('id', Auth::id())->first();
        // dd($updated_user)
        if ($this->tmp_photo)
        {
            storageCreate('profile');
            $photoName = $this->storePhotos($this->tmp_photo, 'profile');
            $updated_user->profile_photo_path = $photoName;
        }

        $updated_user->name = $this->user_name;
        $updated_user->status = $this->status;
        $updated_user->status_emoji = $this->selectedEmoji;
        $updated_user->bio = $this->bio;
        $updated_user->update();

        session()->flash('status', 'profile-updated');
        return redirect()->to('/profile');
    }

    public function deleteProfile()
    {
        $this->validate([
            'confirm_user_name' => ['required'],
        ]);

        return $this->profileUpdateService->deleteAccount($this->confirm_user_name);
    }

    public function selectEmoji($emoji)
    {
        $this->selectedEmoji = $emoji;

    }
}
