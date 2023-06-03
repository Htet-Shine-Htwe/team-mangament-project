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
    use  WithFileUploads;
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

    protected $profileUpdateService;

    protected $listeners = ['loadMore'];
    public function boot(ProfileUpdateService $profileUpdateService,S3FileStorage $storage)
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

        if ($this->tmp_photo)
        {
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

    public function loadMore()
    {
        $this->loadedEmojis += 100;
        $this->emojis = getEmojis($this->loadedEmojis);

         // Optional: You can emit this event to trigger any necessary JavaScript actions after loading more data.
    }

    public function saveCropped(Request $request)
    {
        $image = $request?->image;

        $base64 = substr($image, strpos($image, ',') + 1);
        $utf8Encoded = mb_convert_encoding($base64, 'UTF-8', 'UTF-8');

        // Decode the base64-encoded content
        $decodedData = base64_decode($utf8Encoded);


        return response()->json(['message' => $decodedData ]);



        $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
        $photoName = $this->storage->storePhotos($decodedImage, 'profile');

        if($image)
        {
            return response()->json(['message' => $image]);

            // $updated_user->profile_photo_path = $photoName;
        }

        return response()->json(['message' => $image]);
        return redirect()->to('/dashboard');

    }
}
