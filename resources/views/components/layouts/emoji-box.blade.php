<div class=""  x-data="{ open: false }" wire:ingnore>
    <button wire:click.prevent="" x-on:click="open = true" @keydown.escape="open = false"
     class="px-3 py-2  rounded-l-lg bg-SecondaryBg">
     <span>&#x{{ $selectedEmoji}}</span>
    </button>
    <div x-show="open"
    class="fixed inset-0 flex items-center justify-center  bg-gray-800 bg-opacity-20">
        <div @click.away="open = false"
        class="p-4 bg-SoftBg rounded-lg shadow-xl h-[200px] w-[280px] overflow-scroll">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold">Select an Emoji</h2>
                <button wire:click.prevent="" x-on:click="open = false"  class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-5 gap-2">
                @foreach ($emojis as $emoji)
                    <button  wire:click.prevent="selectEmoji('{{ $emoji['codes'] }}')" class="p-2 bg-SecondaryBg rounded-lg hover:bg-HoverBg focus:outline-none">
                        &#x{{ Str::substr($emoji['codes'] , 0, 5)}}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>