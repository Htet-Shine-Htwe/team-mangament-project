<div class="relative">
    <div class="">
        <header class="text-PrimaryText ">
            <div class="pt-4  text-PrimaryText  sm:rounded-lg">
                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-2xl">Workspace</h3>
                        <p class="text-SecondaryText">Manage your workspace setting</p>
                    </div>
                    <hr class="border-gray-400 mt-4" />
                </div>
            </div>
        </header>

        <div class=" border-b-[1px] w-full border-SeparateBorder">
            <div class="  sm:rounded-lg">
                <div class="px-8 pb-8 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-xl  ">Logo</h3>

                        <div class="my-2">
                            {{-- <x-input-label for="profile" class="mb-3" :value="__('Profile picture')" /> --}}
                            <div class="relative w-20 h-20">
                                @if ($logo)
                                    <img src="{{ $logo->temporaryUrl() }}"
                                        class=" workspacePhoto rounded-xl w-full h-full object-cover" />
                                @else
                                    @if ($workspaceLogo)
                                        <img src="{{ $workspaceLogo }}" class=" workspacePhoto rounded-xl w-full h-full object-cover" />
                                    @else
                                        <div class=" flex items-center workspacePhoto justify-center text-white rounded-xl text-lg"
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

                            <input type="file" name="profile" id="photoInput" class="text-input hidden"
                                wire:model.defer='logo' />

                            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                        </div>

                        <p class="text-SecondaryText text-sm mt-2">Pick a logo for your workspace</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="py-4  text-PrimaryText  sm:rounded-lg">
            <div class="px-8 pb-8 sm:px-24">
                @include('components.delete-workspace')
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let workspacePhoto = $('.workspacePhoto');
            let photoInput = document.getElementById('photoInput');


            workspacePhoto.click(() => {
                photoInput.click();
            })

        })
    </script>
@endpush
