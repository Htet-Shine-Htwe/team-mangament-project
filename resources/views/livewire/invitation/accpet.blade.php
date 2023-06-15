
<div class="w-full h-full flex justify-center items-center relative">
    <div class="absolute top-4 w-full px-6 flex justify-between items-center py-5">
        <div class="flex flex-col space-y-1">
            <p class="text-SecondaryText ">Logged in as:</p>
            <span>{{ Auth::user()->email }}</span>
        </div>

        @hasWorkspace
        <div class="flex flex-col space-y-1">
            <a href="/dashboard" class="text-SecondaryText ">< Back to Linear</a>
        </div>
        @else
        <form action="{{ route('logout') }}" method="POST" >
            @csrf
            <button class="text-SecondaryText ">
                <p>logout</p>
            </button>
        </form>
        @endhasWorkspace
    </div>
    <div class="space-y-4">
        <header class="">
            <div class="mb-7 flex justify-center">
                {{-- <x-input-label for="profile" class="mb-3" :value="__('Profile picture')" /> --}}
                <div class="relative w-20 h-20">
                        @if ($workspaceLogo != 'empty')
                            <img src="{{ $workspaceLogo }}" class=" workspacePhoto rounded-xl w-full h-full object-cover cursor-pointer" />
                        @else
                            <div class=" flex w-full h-full items-center workspacePhoto justify-center text-white rounded-xl text-lg cursor-pointer"
                                style="background-color: {{ $workspace->hax_color }};">
                                <p class="">{{ $workspaceName }}</p>
                                <!-- Content goes here -->
                            </div>
                        @endif
                </div>
            </div>
            <h2 class="text-3xl text-center font-semibold">
                {{ __('Join This Workspace ' . $workspace->name) }}
            </h2>

            <div class="mt-2 text-sm text-SecondaryText  flex justify-center">
                <p class="w-full">{{ __('Workspaces are shared enviroment where teams can work on projects and tasks') }}</p>
            </div>

        </header>
        <div class="flex items-center gap-4 px-20" wire:ignore>
            <button wire:click='acceptWorkspace'
                class = 'px-4 bg-ButtonBg
                hover:bg-ButtonFocus w-full flex items-center justify-center py-4
                border-ButtonBorder rounded-md font-semibold text-xs text-white  uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' wire:loading.attr="disabled">
                <div wire:loading wire:target='save' class="animate-spin flex items-center mr-3">
                    <i class="fa-solid fa-spinner"></i>
                </div>
                <span >
                    {{ __('Join Workspace') }}
                </span>
            </button>
        </div>
    </div>
</div>
