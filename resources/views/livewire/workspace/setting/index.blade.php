<div class="relative ">
    <div class="">
        <header class="text-PrimaryText ">
            <div class="pt-4  text-PrimaryText  sm:rounded-lg">
                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-2xl">Workspace</h3>
                        <p class="text-SecondaryText">Manage your workspace setting</p>
                    </div>
                    <hr class="border-gray-400 mt-6" />
                </div>
            </div>
        </header>

        <div class=" w-full">
            <div class=" sm:rounded-lg">
                <div class="px-8 pb-4 sm:px-24">
                    @include('components.workspaces.workspace-logo-input')
                    <hr class="border-gray-400 mt-6" />
                </div>
            </div>
        </div>

        <div class=" w-full ">
            <div class=" sm:rounded-lg">
                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-xl">General</h3>

                        <p class="text-SecondaryText text-sm mt-2">Pick a logo for your workspace</p>

                        <form wire:submit.prevent='updateWorkspace' class="mt-6 space-y-6  w-3/6">

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <input name="name" id="name" class="text-input mt-2"
                                    wire:model.defer='name' />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="flex items-center gap-4" wire:ignore>
                                <x-primary-button target="updateWorkspace">{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'workspace-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                    <hr class="border-gray-400 mt-6" />
                </div>
            </div>
        </div>

        <div class="py-2  text-PrimaryText  sm:rounded-lg">
            <div class="px-8 pb-4 sm:px-24">
                @include('components.delete-workspace')
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {
                $('img').lazyload();
            })

            let workspacePhoto = $('.workspacePhoto');
            let photoInput = document.getElementById('photoInput');


            workspacePhoto.click(() => {
                photoInput.click();
            })

            $('#photoInput').on('change', function() {
                var reader = new FileReader();
                var file = this.files[0];
                if (file.type === 'image/jpeg' || file.type === 'image/png') {
                        console.log('here')
                } else {
                    // Invalid file type, show an error message or perform any other validation action
                    alert('Invalid file type. Please select a JPG or PNG image.');
                    // Clear the input field if necessary
                    $('#photoInput').val('');
                }


            });

        })
    </script>
@endpush
