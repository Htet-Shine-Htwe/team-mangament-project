<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EmojiModal extends Component
{
    public $isOpen = false;
    public $emojis = [];

    public function openModal()
    {
        $response = Http::get('https://unpkg.com/emoji.json/emoji.json');

        if ($response->ok()) {
            $this->emojis = $response->json();
        }

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function selectEmoji($emoji)
    {
        // Handle the selected emoji as needed
        // For demonstration purposes, we'll just print it to the console
        $this->emit('emojiSelected', $emoji);
    }

    public function render()
    {
        return view('livewire.emoji-modal');
    }
}
