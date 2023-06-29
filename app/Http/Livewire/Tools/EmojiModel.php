<?php

namespace App\Http\Livewire\Tools;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Component;

class EmojiModel extends Component
{
    public int $loadedEmojis = 250;
    public array $emojis;
    public string $selectedEmoji;
    public mixed $user;

    protected $listeners = ['loadMore'];
    public function render() :View
    {
        return view('livewire.tools.emoji-model');
    }

    public function mount(Request $request)
    {
        $this->user = $request->user();

        $this->selectedEmoji = $this->user->status_emoji !== null ? $this->user->status_emoji : '1F600';

        $this->emojis = $this->getCachedEmojis($this->loadedEmojis);
        // dd($this->profile_photo);
    }
    public function selectEmoji(string $emoji) :void
    {
        $this->selectedEmoji = $emoji;

        $this->emit('emojiChanged', $emoji);
    }

    public function loadMore() :void
    {
        $this->loadedEmojis += 100;
        $this->emojis = getEmojis($this->loadedEmojis);//getEmoji is function from helpers

    }

    private function getCachedEmojis(int $limit) :array
    {
        return Cache::remember('emojis-' . $limit, now()->addMinutes(60), function () use ($limit) {
            return getEmojis($limit);
        });
    }
}
