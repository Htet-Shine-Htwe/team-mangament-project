<section>
    <header>
        <h2 class="text-lg font-medium ">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Update your accounts profile information and email addresss.') }}
        </p>

    </header>

    <div class="my-4">
        <x-input-label for="profile" class="mb-3" :value="__('Profile picture')" />

        @if ($tmp_photo)
            <img src="{{ $tmp_photo->temporaryUrl() }} " class="w-32 h-32 object-cover profile_photo rounded-full">
        @else
            @if (Auth::user()->profile_photo_path == null)
                <img src="{{ Auth::user()->avatar }}" class="w-32 h-32 object-cover profile_photo rounded-full" />
            @else
                <img src="{{ $profile_photo }}"
                    class="w-32 h-32 object-cover profile_photo rounded-full" />
            @endif
        @endif
        <input type="file" name="profile" id="profile" class="text-input hidden"
            wire:model.defer='tmp_photo' />

        <x-input-error class="mt-2" :messages="$errors->get('profile')" />
    </div>

    <form wire:submit.prevent='updateProfile' class="mt-6 space-y-6">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input name="name" class="text-input mt-2" wire:model.defer='user_name' />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea name="bio" class="text-input mt-2" wire:model.defer='bio'></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{-- Status Part --}}
        <div>
                <x-input-label for="status_string" :value="__('Status')" />
                <div class="flex items-center mt-2">
                    @include('components.layouts.emoji-box')
                    <input name="status_string" class="rounded-r-md border-gray-300 text-black focus:border-indigo-500 py-2 px-2 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600  shadow-sm  block w-full" wire:model.defer='status' />
                </div>
        </div>

        <div class="flex items-center gap-4" wire:ignore >
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
            let proflie_photo_inputs = $('.profile_photo');
            let profile = document.getElementById('profile');
            profile.click();

            proflie_photo_inputs.click(() => {
                profile.click();
            })

                Livewire.hook('element.updated', function (el, component) {
                    console.log(component)
                    // Livewire.emitTo('profile-component', 'selectedEmoji', emoji);
                });

        })
    </script>
@endpush
