<div class="relative">
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

                        <p class="text-SecondaryText text-sm mt-2">On the Free plan all members in a workspace are
                            administrators. Upgrade to the Standard plan to add the ability to assign or remove
                            administrator roles.</p>

                        <div class="row w-full flex justify-between items-center mt-5">
                            <div class="searchbar">

                            </div>
                            <div class="">
                                <button id="openInvite" class="primary-btn">Invite People</button>
                            </div>
                        </div>

                        <div class="mt-2">
                            @foreach ($workspace->users as $user)
                                <div
                                    class="flex {{ !$loop->first ? 'border-t-[1px] border-[#aaaaafbc] mt-4' : '' }} justify-between items-center pt-4">
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
                                        <p>{{ $user->role($user->id) }}</p>
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


        <div id="inviteModal"
            class="min-w-full min-h-[100vh] absolute top-0 flex items-center justify-center transition-all">
            @if (session()->get('status'))
            <x-alert />
            @endif
            <div id="inviteInnerModal"
                class="pb-7 bg-BackdropBg backdrop-filter shadow z-90 border-SeparateBorder  rounded-lg border-[1px] w-[40vw]">
                <div class="flex flex-col space-y-4 ">


                    <div class="py-4 border-b-2 border-SeparateBorder flex justify-between px-8 ">
                        <p class="text-sm font-medium">Invite People</p>

                        <button id="closeModel" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <x-cross-icon />
                        </button>

                    </div>

                    <div class="w-full border-b-2 border-SeparateBorder px-10 pb-2">

                        <form wire:submit.prevent='invite' class="space-y-6 ">

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <input name="name" id="name" type="email" class="text-input mt-2 "
                                    wire:model.defer="sendEmail" />
                                <p class="text-sm text-red-500">{{ session('sendEmail') }}</p>
                                <x-input-error class="mt-3" :messages="$errors->get('sendEmail')" />
                            </div>

                            <div class="flex items-center gap-4 float-right" wire:ignore>
                                <x-primary-button target="invite">{{ __('Invite') }}</x-primary-button>


                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#inviteModal').hide();

            // $(document).on('click', function(event) {
            //     console.log('thi')
            //     // Check if the click target is outside the model
            //     if (!$(event.target).closest('#inviteInnerModal').length) {
            //         // Close the model here
            //         $('#inviteModal').hide(150);
            //     }
            // });

            $("#openInvite").on('click', function() {

                $('#inviteModal').show();
            })
            $("#closeModel").on('click', function() {

                $('#inviteModal').hide(150);
            })


        })
    </script>
@endpush
