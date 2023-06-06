<div class="w-full flex flex-col">
    <h3 class="text-xl  ">Logo</h3>

    <div class="my-2">
        {{-- <x-input-label for="profile" class="mb-3" :value="__('Profile picture')" /> --}}
        <div class="relative w-20 h-20">
            @if ($logo)
                <img src="{{ $logo->temporaryUrl() }}"
                    class=" workspacePhoto rounded-xl w-full h-full object-cover" />
            @else
                @if ($workspaceLogo != 'empty')
                    <img src="{{ $workspaceLogo }}" class=" workspacePhoto rounded-xl w-full h-full object-cover" />
                @else
                    <div class=" flex w-full h-full items-center workspacePhoto justify-center text-white rounded-xl text-lg"
                        style="background-color: {{ $workspace->hax_color }};">
                        <p class="">{{ $workspaceName }}</p>
                        <!-- Content goes here -->
                    </div>
                @endif

            @endif

            <div wire:loading wire:target='logo'
                class="z-20 backdrop-blur-sm w-full h-full rounded-xl bg-gray-700 bg-opacity-10 flex justify-center items-center absolute  top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex items-center justify-center w-full h-full">
                    <img src="{{ getSpinner() }}"
                        class="fa-solid z-30 w-7 h-7 animate-spin fa-spinner origin-center " />
                </div>
            </div>
        </div>

        <input type="file" name="logo" id="photoInput" class="text-input hidden"
            wire:model.defer='logo' />

        <x-input-error class="mt-2" :messages="$errors->get('logo')" />
    </div>

    <p class="text-SecondaryText text-sm mt-2">Pick a logo for your workspace</p>

</div>
