<div class="relative">
    <div class="" x-data="{openInvite : false}">
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
                            <div class="searchbar relative">
                                <span class="absolute left-2 top-1/2 transform -translate-y-1/2"><i class="fas fa-search text-gray-600"></i></span>
                                <input class="text-input-md py-1 px-8 w-80"
                                placeholder="Search by name or email"
                                wire:model.debounce.900ms = "memberName" />
                            </div>

                            <div class="">
                                <a href ="{{route('workspace.setting.invite',["workspace_name" => $workspace->name])}}" id="openInvite" class="primary-btn">Invite People</a>
                            </div>
                        </div>

                        <div class="mt-2" >
                            @foreach ($workspaceUsers as $user)
                                <div
                                    class="flex {{ !$loop->first ? 'border-t-[1px] border-[#aaaaafbc] mt-4' : '' }} justify-between items-center pt-4">
                                    <div class="flex w-60">
                                        <a href="{{ route('profile.index',['email' => $user->email]) }}" class="mr-3" >
                                            <x-user-profile-photo :user="$user" status="true" class="w-7 h-7" />
                                        </a>
                                        <div class="flex flex-col space-y-1">
                                            <p class="text-sm mb-0">{{ $user->name }}</p>
                                            <p class="text-xs text-SecondaryText">{{ $user->email }}</p>

                                        </div>
                                    </div>

                                    <div class="">
                                        <p>{{ $user->role}}</p>
                                    </div>

                                    <div class="">
                                        Remove
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                  <hr class="border-gray-400 mt-6" />

                </div>

                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-xl">Invitation Requests</h3>

                        <div class="mt-2" >
                            @foreach ($pandads as $invitation)
                                <div
                                    class="flex {{ !$loop->first ? 'border-t-[1px] border-[#aaaaafbc] mt-4' : '' }} justify-between items-center pt-4">
                                    <div class="flex w-60">
                                        <a href="{{ route('profile.index',['email' => $user->email]) }}" class="mr-3" >
                                            <img src="{{ getLogo()}}" class = 'object-cover rounded-full w-6 h-6' />

                                        </a>
                                        <div class="flex flex-col space-y-1">
                                            <p class="text-sm mb-0">{{ $user->email }}</p>
                                            <p class="text-xs text-SecondaryText">{{ $user->status }}</p>
                                        </div>
                                    </div>

                                    <div class="">
                                        <p>{{ $user->role}}</p>
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
            {{ $pandads->links() }}
        </div>


        {{-- <div id="inviteModal"  wire:ignore
            class="min-w-full min-h-[100vh] absolute top-0 flex items-center justify-center transition-all">

            <div id="inviteInnerModal"
                class="pb-7 bg-BackdropBg backdrop-filter shadow z-90 border-SeparateBorder  rounded-lg border-[1px] w-[40vw]">
                <div class="flex flex-col space-y-4 ">

                    <a href ="{{route('workspace.setting.invite',["workspace_name" => $workspace->name])}}" class="py-4 border-b-2 border-SeparateBorder flex justify-between px-8 ">
                        <p class="text-sm font-medium">Invite People</p>

                        <button id="closeModel" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <x-cross-icon />
                        </button>

                    </a>



                </div>
            </div>
        </div> --}}


    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        })
    </script>
@endpush
