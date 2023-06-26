<div class="dropdown dropdown-end">
    <label tabindex="0" class=" m-1 flex bg-SoftBg py-2 px-4 rounded-lg items-center gap-x-2 text-xs drop-shadow-lg">
        {{-- p tag with tag icon --}}
            <i class="fa-solid fa-circle text-[{{ $currentStatus['color'] }}]"></i>
            <span class="text-SecondaryText">{{ $currentStatus['title'] }}</span>
    </label>
    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 bg-SoftBg drop-shadow-lg rounded-box w-40">
    @forelse ($statues as $status)
      <li>
        <button wire:click='changeStatus({{$status->id}})'>
        <div class="p-1 py-[1px] rounded-full border-[1px] border-[{{ $status->color }}]">
            <i class="fa-solid fa-circle text-xs text-[{{ $status->color }}]"></i>
        </div>
        <p class="text-SecondaryText">{{$status->title}}</p></button>
      </li>
    @empty
       <p>No statues </p>
    @endforelse

    </ul>
  </div>
