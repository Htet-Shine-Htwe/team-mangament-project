<div class="dropdown dropdown-end">
    <label tabindex="0" class=" m-1 flex bg-SoftBg py-[6px] pl-3 pr-5 justify-start rounded-lg text-xs items-center gap-x-2  drop-shadow-lg cursor-pointer">
        {{-- p tag with tag icon --}}
        <div wire:loading wire:currentAssign='changeAssign' class="animate-spin flex items-center mr-1">
            <i class="fa-solid fa-spinner"></i>
        </div>
            <span class="text-SecondaryText text-[10px]">{{ niceTitle($currentAssign['name'],2) }}</span>
    </label>
    <ul tabindex="0" wire:ignore class="dropdown-content z-[1] menu p-2 bg-SoftBg drop-shadow-lg rounded-box w-40 max-h-40 overflow-y-scroll">
    @forelse ($users as $user)
      <li>
        <button wire:click='changeAssign({{$user['id']}})'>
        {{-- <div class="p-1 py-[1px] rounded-full border-[1px] border-[{{ $user->color }}]">
            <i class="fa-solid fa-circle text-xs text-[{{ $status->color }}]"></i>
        </div> --}}
        <div class="flex gap-x-1 items-center">
            <x-user-profile-photo :user="$user" status="true" class="w-4 h-4" />

            <p class="text-SecondaryText text-xs">{{$user['name']}}</p>
        </div>
    </button>
      </li>
    @empty
       <p>No users </p>
    @endforelse

    </ul>
  </div>
