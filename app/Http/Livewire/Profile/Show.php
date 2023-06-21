<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Services\ProfileUpdateService;
use App\Services\WorkspaceHelper;
use App\Storage\S3FileStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;
    public $user;
    public string $user_name;
    public $profile_photo;
    public $tmp_photo;
    public string $confirm_user_name;
    public $selectedEmoji;
    public $status = "";
    public $bio = "";
    protected $storage;

    public $loading = false;

    public $currentWorkspace;

    protected $profileUpdateService;

    protected $listeners = ['startLoading', 'stopLoading','emojiChanged'];
    public function boot(ProfileUpdateService $profileUpdateService, S3FileStorage $storage) :void
    {
        $this->profileUpdateService = $profileUpdateService;
        $this->storage = $storage;
    }

    public function mount(Request $request) :void
    {
        $this->user = $request->user();
        $this->currentWorkspace = WorkspaceHelper::getCurrentWorkspace();
        if (!$this->user == null)
        {
            $this->user_name = $this->user->name;
            $this->profile_photo = $this->user->profile_photo_path;
            $this->profile_photo = $this->storage->getPhoto($this->profile_photo, 'profile');
            $this->status = $this->user->status;
            $this->selectedEmoji = $this->user->status_emoji !== null ? $this->user->status_emoji : '1F600';
            $this->bio = $this->user->bio;
        }
        // dd($this->profile_photo);
    }

    public function render() :View
    {
        return view('livewire.profile.show');
    }

    public function updateProfile()
    {
        $this->validate([
            'user_name' =>  'required|min:3',
            'status' =>  'min:3',
            'selectedEmoji' =>  'min:3',
            'bio' =>  'min:3',
        ]);
        $updated_user = User::where('id', Auth::id())->first();
        $updated_user->name = $this->user_name;
        $updated_user->status = $this->status;
        $updated_user->status_emoji = $this->selectedEmoji;
        $updated_user->bio = $this->bio;
        $updated_user->update();

        session()->flash('status', 'profile-updated');
        return redirect()->route('profile.show',['workspace'=>$this->currentWorkspace->name,'email' => $updated_user->email]);
    }

    public function deleteProfile()  :Redirector
    {
        $this->validate([
            'confirm_user_name' => 'required',
        ]);

        return $this->profileUpdateService->deleteAccount($this->confirm_user_name);
    }

    public function saveCropped(Request $request) :void
    {
        $updated_user = User::where('id', Auth::id())->first();

        $request->validate([
            'image'  => 'required|file|mimes:png,jpg,max:3072'
        ]);
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

    public function emojiChanged($emoji) :void
    {
        $this->selectedEmoji = $emoji;
    }

    public function startLoading() :void
    {
        $this->loading = true;
    }

    public function stopLoading() :void
    {
        $this->loading = false;
    }
}
