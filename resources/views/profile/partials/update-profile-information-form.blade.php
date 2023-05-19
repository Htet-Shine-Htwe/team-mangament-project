<section>
    <header>
        <h2 class="text-lg font-medium ">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Update your accounts profile information and email address.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form wire:submit.prevent='updateProfile' class="mt-6 space-y-6">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input name ="name" class="text-input" wire:model.defer='user_name'/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
