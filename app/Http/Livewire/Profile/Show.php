<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Services\ProfileUpdateService;
use App\Storage\LocalFileStorage;
use App\Traits\UsePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
class Show extends Component
{
    use  WithFileUploads;
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

    protected $storage;
    // public $test_photo;

    protected $profileUpdateService;

    public function boot(ProfileUpdateService $profileUpdateService,LocalFileStorage $storage)
    {
        $this->profileUpdateService = $profileUpdateService;
        $this->storage = $storage;
    }

    public function mount(Request $request)
    {
        $this->user = $request->user();
        if (!$this->user == null)
        {
            $this->user_name = $this->user->name;
            $this->profile_photo = $this->user->profile_photo_path;
            $this->profile_photo = $this->storage->getPhoto($this->profile_photo, 'profile');
            $this->status = $this->user->status;
            $this->selectedEmoji = $this->user->status_emoji !== null ? $this->user->status_emoji  : '1F600';
            $this->bio = $this->user->bio;

            // $image = Storage::disk('s3')->url('9k.jpeg');
            // $this->test_photo = $image;
        }
        $this->emojis = getEmojis($this->loadedEmojis);
        // dd($this->profile_photo);
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
            $photoName = $this->storage->storePhotos($this->tmp_photo, 'profile');
            $updated_user->profile_photo_path = $photoName;
        }

        $updated_user->name = $this->user_name;
        $updated_user->status = $this->status;
        $updated_user->status_emoji = $this->selectedEmoji;
        $updated_user->bio = $this->bio;
        $updated_user->update();

        session()->flash('status', 'profile-updated');
        return redirect()->to('/profile/show');
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
