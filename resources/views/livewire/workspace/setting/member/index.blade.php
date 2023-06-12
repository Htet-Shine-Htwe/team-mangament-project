<div class="relative ">
    <div class="">
        <header class="text-PrimaryText ">
            <div class="pt-4  text-PrimaryText  sm:rounded-lg">
                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-2xl">Members</h3>
                        <p class="text-SecondaryText text-sm">Manage who has access to this workspace</p>
                    </div>
                    <hr class="border-gray-400 mt-6" />
                </div>
            </div>
        </header>

        <div class=" w-full ">
            <div class=" sm:rounded-lg">
                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-xl">Manage Members</h3>

                        <p class="text-SecondaryText text-sm mt-2">On the Free plan all members in a workspace are administrators. Upgrade to the Standard plan to add the ability to assign or remove administrator roles.</p>

                        <div class="row w-full flex justify-between items-center mt-5">
                            <div class="searchbar">

                            </div>
                            <div class="">
                                <x-primary-button target="">{{ __('Invite People') }}</x-primary-button>


                            </div>
                        </div>

                        <div class="mt-2">
                            @foreach ($workspace->users as $user)
                            <div class="flex {{ !$loop->first ? 'border-t-[1px] border-[#aaaaafbc] mt-4' : '' }} justify-between items-center pt-4">
                                    <div class="flex w-60">
                                        <div class="mr-3">
                                            <x-user-profile-photo :user="$user" status="true" class="w-7 h-7" />
                                        </div>
                                        <div class="flex flex-col space-y-1">
                                            <p class="text-sm mb-0">{{ $user->name }}</p>
                                            <p class="text-xs text-SecondaryText">{{ $user->email }}</p>

                                        </div>
                                    </div>

                                    <div class="">
                                        <p>Admin</p>
                                    </div>

                                    <div class="">
                                        Remove
                                    </div>

                             </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        })
    </script>
@endpush
