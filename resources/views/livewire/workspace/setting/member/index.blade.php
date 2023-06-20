<div class="relative h-[100vh] overflow-y-scroll pt-3 pb-6">
    @if (session()->get('status'))
    <x-alert />
    @endif
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

        {{--        *******************  Get Member Lists *******************  --}}
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
                                wire:model.debounce.500ms = "memberName" />
                            </div>

                            <div class="">
                                  <div wire:loading wire:target='removeMember' class="animate-spin flex items-center mr-3">
                                            <i class="fa-solid fa-spinner"></i>
                                        </div>
                                <a href ="{{route('workspace.setting.invite',["workspace_name" => $workspace->name])}}" id="openInvite" class="primary-btn">Invite People</a>
                            </div>
                        </div>

                        <div class="mt-2" >
                            @foreach ($workspaceUsers as $user)
                                <div
                                    id="member-{{ $user->id }}"
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

                                    <div class="" wire:ignore>
                                        <p>{{ $user?->role }}</p>
                                    </div>

                                    <div class="">
                                    @if($adminCheck)
                                    <button wire:click="removeMember({{ $user }})" class="px-2 py-1 text-sm bg-red-600 hover:bg-red-800 transition-all rounded-lg">

                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </button>
                                    @endif
                                </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                  <hr class="border-gray-400 mt-6" />

                </div>
                 {{--        *******************  Get Remove member model *******************  --}}
                 @if ($removeModel)

                 <div id="removeMemberModal"
                 class="min-w-full min-h-[100vh] absolute top-0 flex items-center justify-center transition-all">
                    <livewire:workspace.setting.member.remove-member :user="$selectedUser" :workspace="$workspace"  />
                 </div>
                 @endif

                 {{--        *******************  Get Invitations Lists *******************  --}}
                 @if($adminCheck)

                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <div class="flex items-center">
                            <h3 class="text-xl">Invitation Requests</h3>
                            <div wire:loading wire:target='cancelInvitation' class="animate-spin flex items-center ml-4">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                        </div>

                        <div class="mt-2 max-h-80 overflow-y-scroll" >
                            @forelse ($invitations as $invitation)
                                <div
                                    class="flex {{ !$loop->first ? 'border-t-[1px] border-[#aaaaafbc] mt-4' : '' }} justify-between items-center pt-4">
                                    <div class="flex w-60">
                                        {{-- <a href="{{ route('profile.index',['email' => $user->email]) }}" class="mr-3" >
                                            <img src="{{ getLogo()}}" class = 'object-cover rounded-full w-6 h-6' />

                                        </a> --}}
                                        <div class="flex flex-col space-y-1">
                                            <p class="text-sm mb-0">{{ $invitation->email ?? $invitation['email'] }}</p>
                                            <p class="text-xs text-SecondaryText">{{ $invitation->status ??$invitation['status'] }}</p>
                                        </div>
                                    </div>


                                    <button wire:click="cancelInvitation('{{$invitation->id ?? $invitation['id']}}')" class="btn-red ">
                                        <span>Cancel</span>
                                    </button>

                                </div>
                                @empty
                                <p class="text-center text-secondaryText text-sm">No invitations in current workspace</p>
                            @endforelse
                        </div>
                        <div class="flex justify-between">
                            <div class="">

                            </div>
                            @if (count($invitations) > 3 && !session()->get('invitation') )
                           <button class="primary-btn mt-2"  wire:click="moreInvitations">
                            <div wire:loading wire:target='moreInvitations' class="animate-spin flex items-center mr-3">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                            <span >
                                {{ __('Load more') }}
                            </span>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
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
            // $(".invite-box").hide();


        })
    </script>
@endpush
