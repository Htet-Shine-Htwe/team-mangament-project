<?php

namespace App\Http\Livewire;

use App\Models\Icon;
use App\Models\User;
use App\Traits\UsePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class ProfileComponent extends Component
{
    use UsePhoto, WithFileUploads;
    public $user;
    public $user_name;
    public $loadedEmojis = 200;
    public $profile_photo;
    public $tmp_photo;
    public $confirm_user_name;
    public $emojis;
    public $isOpen = false;
    public $selectedEmoji;
    public $status = "";

    public $bio = "";
    public function mount(Request $request)
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
        $this->emojis = $this->getEmojis($this->loadedEmojis);
        // dd($this->emojis);
    }

    public function render()
    {
        return view('livewire.profile-component');
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


        $user = User::where('id', Auth::id())->first();

        if ($this->confirm_user_name == $user->name)
        {
            Auth::logout();

            $user->delete();

            session()->invalidate();
            session()->regenerateToken();
            return redirect()->to('/login');
        }
        dd('here');
        session()->flash('confirm', 'name is not matched');
    }

    private function getEmojis($limit)
    {
        return Cache::remember('emojis', 3600, function () use ($limit) {
            $response = Http::get('https://unpkg.com/emoji.json/emoji.json');
    
            if ($response->ok()) {
                $emojis = $response->json();
                $emojis = array_slice($emojis, 0, $limit);
    
                return $emojis;
            }
        });
    }


    public function selectEmoji($emoji)
    {
        $this->selectedEmoji = $emoji;
        $this->closeModel();
    }

    public function openModel()
    {
        $this->isOpen = true;
    }

    public function closeModel()
    {
        $this->isOpen = false;
    }

}
