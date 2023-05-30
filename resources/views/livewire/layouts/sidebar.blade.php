<div class="w-full bg-PrimaryBg h-full pt-4 text-PrimaryText">

    <div class="top-bar pl-5 pr-2 flex justify-between items-center">
        @include('components.layouts.workspace-dropdown')
        <div class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full border-SecondaryBg transition-all">
            <a href="{{ route('profile.index') }}" class="">
                @if (Auth::user()->profile_photo_path == null)
                <img src = "{{ Auth::user()->avatar }}" class="w-6 h-6 object-cover rounded-full" />
                @else
                <img src = "{{ getProfilePhoto(Auth::user()->profile_photo_path,app('storageProvider')) }}" class="w-6 h-6 object-cover rounded-full" />
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
            <button class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-5 pr-2 py-2 ">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p>logout</p>
            </button>
        </form>
    </div>
</div>
