<section class="space-y-6" >
    <header>
        <h2 class="text-lg font-medium ">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable >
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.  ') }}
            </p>
            <p class="text-red-600"> Type *<span class="text-red-700">{{ $user_name }}</span>*  to delete you account</p>
            <div class="mt-6" wire:ignore >
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <input id="confirm_account" class ="text-input" placeholder="Your account Name" wire:model.defer="confirm_user_name"/>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <button id="deleteButton" wire:click='deleteProfile'

                class='ml-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150
                disabled:bg-red-200'>
                    {{ __('Delete') }}
                </button>
            </div>
        </div>
    </x-modal>
</section>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Access Livewire property example

    let confrim_account = document.getElementById('confirm_account');
    let deleteButton = document.getElementById('deleteButton');
    let confirm_name = @json($user_name);
    deleteButton.setAttribute('disabled',true)

    confrim_account.addEventListener('keyup',()=>{
        name = confrim_account.value;
        if(name !== confirm_name)
        {
            deleteButton.setAttribute('disabled',true)
        }
        else{
            deleteButton.removeAttribute('disabled')

        }

    })
    });

</script>
@endpush
