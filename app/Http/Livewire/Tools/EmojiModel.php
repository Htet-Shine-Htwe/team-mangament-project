<?php

namespace App\Http\Livewire\Tools;

use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class EmojiModel extends Component
{
    public int $loadedEmojis = 250;
    public $emojis;
    public $selectedEmoji;
    public $user;

    protected $listeners = ['loadMore'];
    public function render()
    {
        return view('livewire.tools.emoji-model');
    }

    public function mount(Request $request,S3Client $s3)
    {
        $this->user = $request->user();

        $this->selectedEmoji = $this->user->status_emoji !== null ? $this->user->status_emoji : '1F600';


        $this->emojis = $this->getCachedEmojis($this->loadedEmojis);
        // dd($this->profile_photo);
    }
    public function selectEmoji($emoji)
    {
        $this->selectedEmoji = $emoji;

        $this->emit('emojiChanged', $emoji);
    }

    public function loadMore()
    {
        $this->loadedEmojis += 100;
        $this->emojis = getEmojis($this->loadedEmojis);//getEmoji is function from helpers

    }

    private function getCachedEmojis($limit)
    {
        return Cache::remember('emojis-' . $limit, now()->addMinutes(60), function () use ($limit) {
            return getEmojis($limit);
        });
    }
}
