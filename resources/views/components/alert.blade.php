<div class="px-8 mt-3 absolute top-0 right-0">
    @php
        $rand = rand(0,500000);
    @endphp
    <p x-data="{ show{{ $rand }}: true }" x-show="show{{ $rand }}" x-transition x-init="setTimeout(() => show{{ $rand }} = false, 5000)"
        class="text-sm text-white capitalize bg-green-500 bg-opacity-90 px-4 py-2 rounded-lg ">{{ __(session()->get('status')) }}</p>
</div>
