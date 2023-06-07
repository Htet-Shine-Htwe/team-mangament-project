<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Services\ProfileUpdateService;
use App\Storage\LocalFileStorage;
use App\Storage\S3FileStorage;
use App\Traits\UsePhoto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;
    public $user;
    public string $user_name;
    public int $loadedEmojis = 250;
    public $profile_photo;
    public $tmp_photo;
    public string $confirm_user_name;
    public $emojis;
    public $selectedEmoji;
    public $status = "";
    public $bio = "";
    protected $storage;

    public $loading = false;

    protected $profileUpdateService;

    protected $listeners = ['loadMore','startLoading', 'stopLoading'];
    public function boot(ProfileUpdateService $profileUpdateService, S3FileStorage $storage)
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
            $this->selectedEmoji = $this->user->status_emoji !== null ? $this->user->status_emoji : '1F600';
            $this->bio = $this->user->bio;
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
            'confirm_user_name' => 'required',
        ]);

        return $this->profileUpdateService->deleteAccount($this->confirm_user_name);
    }

    public function selectEmoji($emoji)
    {
        $this->selectedEmoji = $emoji;
    }

    public function loadMore()
    {
        $this->loadedEmojis += 100;
        $this->emojis = getEmojis($this->loadedEmojis);

        // Optional: You can emit this event to trigger any necessary JavaScript actions after loading more data.
    }

    public function saveCropped(Request $request)
    {
        $updated_user = User::where('id', Auth::id())->first();

        if ($request->hasFile('image'))
        {
            $uploadedFile = $request->file('image'); // 'image' is the name of the file input field in the form
            $path = storageCreate('profile');
            $photoName = "photoImage" . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->storeAs($path, $photoName, 's3');
            $updated_user->profile_photo_path = $photoName;
            $updated_user->update();

            session()->flash('status', 'profile-updated');
        }

        session()->flash('status', 'image-not-found');

    }

    public function startLoading()
    {
        $this->loading = true;
    }

    public function stopLoading()
    {
        $this->loading = false;
    }
}
