{{-- column  --}}
<div wire:ignore wire:key='col-{{ $issue['id'] }}'
class="issues-col px-12 py-6  w-full flex justify-between items-center border-b-[1px] border-SeparateBorder ">
<div class="flex items-center gap-x-2">
    <p class="text-SecondaryText text-xs">NOV - {{ $issue['id']}}</p>
    <i style="color: {{ $color }}" class="fa-solid fa-circle "></i>
    <p class="font-medium text-sm">{{ $issue['title'] }}</p>
</div>
<div class="flex gap-x-2 items-center">
    <p class="text-xs text-SecondaryText">{{ $issue['created_at']}}</p>
    <div
        class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full w-fit border-SecondaryBg transition-all relative">

        {{-- <x-user-profile-photo :user="$issue->user" status="true" class="w-6 h-6" /> --}}
    </div>
</div>
</div>
{{-- column --}}
