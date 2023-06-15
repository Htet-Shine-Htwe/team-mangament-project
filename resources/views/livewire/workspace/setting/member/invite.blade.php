
<div class="w-full h-full flex justify-center items-center relative">
    <div class="absolute top-6 w-full px-6 flex justify-between items-center py-5">
        <div class="flex flex-col space-y-1">
            <p class="text-SecondaryText ">Logged in as:</p>
            <span>{{ Auth::user()->email }}</span>
        </div>
        @if (session()->get('status'))
        <x-alert />
        @endif
        @hasWorkspace
        <div class="flex flex-col space-y-1">
            <a href ="{{route('workspace.setting.member',["workspace_name" => $workspace->name])}}" class="text-SecondaryText ">< Back to Linear</a>
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
                {{ __('Invite a new member to '.$workspace->name) }}

            </h2>

            <div class="mt-2 text-sm text-SecondaryText  flex justify-center">
                <p class="w-[95%]">{{ __('Workspaces are shared enviroment where teams can work on projects and tasks') }}</p>
            </div>

        </header>
        <div class=" text-PrimaryText w-full bg-SoftBg h-fit rounded-lg shadow-lg ">
            <div class="px-12 py-4">
                <section>

                    <div class="w-full px-5">

                        <form  class="space-y-5">

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <input name="name" id="name" type="email" class="text-input mt-2 w-96"
                                    wire:model.defer="sendEmail" />
                                <p class="text-sm text-red-500">{{ session('sendEmail') }}</p>
                                <x-input-error class="mt-3" :messages="$errors->get('sendEmail')" />
                            </div>

                            <div class="flex items-center justify-between gap-4 " wire:ignore>
                                <div class=""></div>
                                <x-primary-button target="invite">{{ __('Invite') }}</x-primary-button>
                            </div>
                        </form>
                    </div>

                </section>
            </div>
        </div>

    </div>
</div>
