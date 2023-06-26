<div class="dropdown dropdown-end">
    <label tabindex="0" class=" m-1 flex bg-SoftBg py-[6px] pl-3 pr-5 justify-start rounded-lg text-xs items-center gap-x-2  drop-shadow-lg cursor-pointer">
        {{-- p tag with tag icon --}}
            <i class="fa-solid fa-circle text-[{{ $currentStatus['color'] }}]"></i>
            <span class="text-SecondaryText text-[10px]">{{ $currentStatus['title'] }}</span>
    </label>
    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 bg-SoftBg drop-shadow-lg rounded-box w-40">
    @forelse ($statues as $status)
      <li>
        <button wire:click='changeStatus({{$status->id}})'>
        <div class="w-5 h-5 flex justify-center items-center rounded-full border-[1px] border-[{{ $status->color }}]">
            <i class="fa-solid fa-circle text-[10px] text-[{{ $status->color }}]"></i>
        </div>
        <p class="text-SecondaryText text-xs">{{$status->title}}</p></button>
      </li>
    @empty
       <p>No statues </p>
    @endforelse

    </ul>
  </div>
