<div class="w-full bg-SecondaryBg h-full pt-8 text-SecondaryText">

    <div class="top-bar pl-3 pr-2 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="flex gap-x-1 items-center">
            <img src ="{{ getLogo() }}" class="w-8 h-8 fill-current text-gray-500" />
            <p class="font-Kanit font-medium">{{ Auth::user()->name }}</p>
        </a>
        <div class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full border-SecondaryBg transition-all">
            <a href="{{ route('profile.show') }}" class="">
                @if (Auth::user()->profile_photo_path == null)
                <img src = "{{ Auth::user()->avatar }}" class="w-6 h-6 object-cover rounded-full" />
                @else
                <img src = "{{ getProfilePhoto(Auth::user()->profile_photo_path) }}" class="w-6 h-6 object-cover rounded-full" />
                @endif
            </a>
        </div>
    </div>

    <div class="mt-4 flex flex-col gap-y-5">
        <x-layouts.sidebar-item name="setting" iconClass="fa-solid fa-gear" />
    </div>

    <div class="mt-4 flex flex-col gap-y-5">
        <form action="{{ route('logout') }}" method="POST" >
            @csrf
            <button class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-3 pr-2 py-2 ">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p>logout</p>
            </button>
        </form>
    </div>
</div>
