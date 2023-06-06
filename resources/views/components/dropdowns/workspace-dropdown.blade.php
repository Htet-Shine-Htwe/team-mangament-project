<div class="relative " x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
        class="flex items-center">
        <p href="{{ route('dashboard') }}" class="flex  items-center">
            <x-profile.workspace-photo :photo="false" haxColor="" :workspace="$currentWorkspace" />
            <p class="font-Kanit font-medium text-sm ml-2">
                {{ niceTitle($currentWorkspace->name) }}
            </p>
        </p>
    </button>
    <div x-show="isOpen" @click.away="isOpen = false" x-cloak
        class="absolute left-1 font-normal flex flex-col  bg-SecondaryBg backdrop-filter shadow overflow-hidden rounded w-64 border border-SeparateBorder mt-2 py-3 right-0 z-40 text-sm">
        <div class="px-4">
            <p class="text-sm text-SecondaryText">{{ Auth::user()->email }}</p>
        </div>
        <ul class="mt-3 pb-4 border-b border-SeparateBorder">
            @foreach ($workspaces as $workspace)
            <li class="flex space-x-8 items-start mt-1">
                <button wire:click="switchWorkspace('{{ $workspace->name }}')" class="w-full flex items-center spaces-x-3 hover:cursor-pointer px-4 py-1 hover:bg-HoverBg hover:text-HoverText ">
                    <img src ="{{ getLogo() }}" class="w-7 h-7 fill-current mr-3 object-contain text-gray-500" />

                    <p>{{ niceTitle($workspace->name) }}</p>
                </button>
            </li>
            @endforeach
        </ul>

        <a href="{{ route('workspace.create') }}"  class="px-4 py-2 hover:cursor-pointer hover:bg-HoverBg hover:text-HoverText mt-2">
            <p class="text-xs text-SecondaryText">Create Workspace</p>
        </a>

        <a href="{{ route('workspace.setting.index',['workspace' => $currentWorkspace->name]) }}"  class="px-4 py-2 hover:cursor-pointer hover:bg-HoverBg hover:text-HoverText ">
            <p class="text-xs text-SecondaryText">Workspace Setting</p>
        </a>

        <form action="{{ route('logout') }}" class="px-4 py-2 hover:cursor-pointer hover:bg-HoverBg hover:text-HoverText " method="POST" >
            @csrf
            <p class="text-xs text-SecondaryText">Logout</p>
        </form>

    </div>
</div>
