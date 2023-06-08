
<div class="w-full h-full flex justify-center items-center relative">
    <div class="absolute top-6 w-full px-6 flex justify-between items-center py-5">
        <div class="flex flex-col space-y-1">
            <p class="text-SecondaryText ">Logged in as:</p>
            {{-- <span>{{ Auth::user()->email }}</span> --}}
        </div>

        {{-- @hasWorkspace
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
        @endhasWorkspace --}}
    </div>
    <div class="space-y-4">
        <header class="">
            <h2 class="text-3xl text-center font-semibold">
                {{ __('Join This Workspace ' . $workspace->name) }}
            </h2>

            <div class="mt-2 text-sm text-SecondaryText  flex justify-center">
                <p class="w-[95%]">{{ __('Workspaces are shared enviroment where teams can work on projects and tasks') }}</p>
            </div>

        </header>
        <div class=" text-PrimaryText w-full bg-SoftBg rounded-lg shadow-lg ">
            <div class="px-12 py-4">
                <section>

                    {{-- <form wire:submit.prevent='save' class="my-3 space-y-6 ">

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <input name="name" id="name" class="text-input mt-2"
                                wire:model.defer='workspaceName' />
                            <x-input-error class="mt-2" :messages="$errors->get('workspaceName')" />
                        </div>

                    </form> --}}

                </section>
            </div>
        </div>
        {{-- <div class="flex items-center gap-4 px-20" wire:ignore>
            <button wire:click='save'
                class = 'px-4 bg-ButtonBg
                hover:bg-ButtonFocus w-full flex items-center justify-center py-4
                border-ButtonBorder rounded-md font-semibold text-xs text-white  uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' wire:loading.attr="disabled">
                <div wire:loading wire:target='save' class="animate-spin flex items-center mr-3">
                    <i class="fa-solid fa-spinner"></i>
                </div>
                <span >
                    {{ __('Create Workspace') }}
                </span>
            </button>
        </div> --}}
    </div>
</div>
