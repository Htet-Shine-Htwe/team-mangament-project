{{-- row  --}}
<div wire:ignore wire:key='row-{{ $issue['id'] }}'
class="issues-row px-12 py-3  w-[300px] flex justify-between items-center border-b-[1px] border-SeparateBorder ">
<div class="flex flex-col  gap-y-2">
    <p class="text-SecondaryText text-xs">NOV - {{ $issue['id'] }}</p>
    <p class="font-medium text-sm">{{ $issue['title'] }}</p>
</div>
<div class="flex gap-y-2 items-center flex-col-reverse">
    <p class="text-[10px] text-SecondaryText">{{ $issue['created_at']}}</p>
    <div
        class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full w-fit border-SecondaryBg transition-all relative">

        {{-- <x-user-profile-photo :user="$issue->user" status="true" class="w-4 h-4" /> --}}
    </div>
</div>
</div>
{{-- row --}}
