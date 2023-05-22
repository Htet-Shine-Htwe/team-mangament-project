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
            <input name="name" class="text-input" wire:model.defer='user_name' />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <i class="{{ $icons[0]->prefix . $icons[0]->icon_name }}"></i>

        <div>
            <div class="flex items-center">
                <div class="">
                    <!-- Replace "icon-placeholder" with your desired icon component or class -->
                    <span class="icon-placeholder"></span>
                </div>
                <select wire:model="selectedIcon" class="block text-black bg-gray-400 w-full px-4 py-2 rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    <option value="">Select an icon</option>
                    <option value="fa fa-bell" class="fa">&#xf2bb; bell</option>
                    @foreach ($icons as $icon)

                    <option value="{{ $icon->prefix . $icon->icon_name }}" class="fa">&#x{{ $icon->unicode }} {{$icon->icon_name}}
                    </option>

                    @endforeach

                </select>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
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
        })
    </script>
@endpush
