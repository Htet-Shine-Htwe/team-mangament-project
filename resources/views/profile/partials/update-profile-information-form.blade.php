<section>
    <header>
        <h2 class="text-lg font-medium ">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Update your accounts profile information and email addresss.') }}
        </p>

    </header>

    <div class="my-4 ">
        <x-input-label for="profile" class="mb-3" :value="__('Profile picture')" />
        <div class="relative w-32 h-32 rounded-full">

            @if (Auth::user()->profile_photo_path == null)
                <img src="{{ Auth::user()->avatar }}"
                    class="w-32 h-32 object-cover profile_photo rounded-full hover-circle-indigo cursor-pointer" />
            @else
                <img src="{{ getPhoto(Auth::user()->profile_photo_path, 'profilePhoto') }}"
                    class="w-32 h-32 object-cover profile_photo rounded-full hover-circle-indigo cursor-pointer" />
            @endif

            <div wire:loading wire:target='tmp_photo'
                class="z-20 backdrop-blur-sm rounded-full w-full h-full bg-gray-700 bg-opacity-10 flex justify-center items-center absolute  top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex items-center justify-center w-full h-full">
                    <img src="{{ getSpinner() }}"
                        class="fa-solid z-30 w-7 h-7 animate-spin fa-spinner origin-center " />
                </div>
            </div>

        </div>

        <input type="file" name="profile" id="profile" class="text-input hidden" wire:model.defer='tmp_photo' />

        <x-input-error class="mt-2" :messages="$errors->get('profile')" />
    </div>

    <form wire:submit.prevent='updateProfile' class="mt-6 space-y-6  w-3/6">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input name="name" id="name" class="text-input mt-2" wire:model.defer='user_name' />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea name="bio" id="bio" class="text-input mt-2 " wire:model.defer='bio'></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>


        {{--   Emoji & Status Part --}}
        <div>
            <x-input-label for="status_string" :value="__('Status')" />
            <div class="flex items-center mt-2">
                {{-- @include('components.layouts.emoji-box') --}}
                <livewire:tools.emoji-model >
                <input name="status_string"
                    class="rounded-r-md input-bg !border-[1px] border-gray-300 text-black focus:border-indigo-500 py-2 px-2  focus:ring-indigo-500  shadow-sm  block w-full"
                    wire:model.defer='status' />
            </div>
        </div>

        <div class="flex items-center gap-4" wire:ignore>
            <x-primary-button target="updateProfile">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved') }}</p>
            @endif
        </div>
    </form>

</section>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#cropModel').hide();

            let proflie_photo_inputs = $('.profile_photo');
            let profile = document.getElementById('profile');


            proflie_photo_inputs.click(() => {
                profile.click();
            })


        });
    </script>
@endpush
