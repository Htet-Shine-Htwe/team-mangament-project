<button wire:click.prevent='{{ $target }}' type="submit" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ButtonBg
    hover:bg-ButtonFocus
    border-ButtonBorder rounded-md font-semibold text-xs text-white  uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150']) }} wire:loading.attr="disabled">
    <div wire:loading wire:target='{{$target}}' class="animate-spin flex items-center mr-3">
        <i class="fa-solid fa-spinner"></i>
    </div>
    <span >
        {{ $slot }}
    </span>
</button>
