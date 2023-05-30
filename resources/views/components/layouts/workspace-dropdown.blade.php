<div class="relative " x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
        class="flex items-center">
        <p href="{{ route('dashboard') }}" class="flex gap-x-1 items-center">
            <img src ="{{ getLogo() }}" class="w-12 h-12 fill-current text-gray-500" />
            <p class="font-Kanit font-medium">{{ Auth::user()->name }}</p>
        </p>
    </button>
    <div x-show="isOpen" @click.away="isOpen = false" x-cloak
        class="absolute left-1 font-normal flex flex-col  bg-SecondaryBg backdrop-filter shadow overflow-hidden rounded w-64 border border-SeparateBorder mt-2 py-3 right-0 z-40">
        <div class="px-4">
            <p class="text-sm text-SecondaryText">{{ $user->email }}</p>
        </div>
        <ul class="mt-3 pb-4 border-b border-SeparateBorder">
            @foreach ($workspaces as $workspace)
            <li class="flex gap-x-8 items-start">
                <a href="{{ route('workspace.index', [$workspace->name]) }}" class="w-full flex items-center spaces-x-3 hover:cursor-pointer px-4 py-1 hover:bg-HoverBg hover:text-HoverText ">
                    <img src ="{{ getLogo() }}" class="w-7 h-7 fill-current text-gray-500" />

                    <p>{{ $workspace->name }}</p>
                </a>
            </li>
            @endforeach
        </ul>

        <a href="{{ route('workspace.create') }}"  class="px-4 py-2 hover:cursor-pointer hover:bg-HoverBg hover:text-HoverText mt-2">
            <p class="text-sm text-PrimaryText">Create Workspace</p>
        </a>

    </div>
</div>
