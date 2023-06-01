<div
    class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full w-fit border-SecondaryBg transition-all relative">

    <img src="{{ $photo }}" {{ $attributes->merge(['class' => 'object-cover rounded-full']) }} />

    <x-online-status :user="$user" />

</div>
