
    <div id="removeMemberInnerModal"
        class="pb-7 bg-BackdropBg backdrop-filter shadow z-90 border-SeparateBorder relative  rounded-lg border-[1px] w-[40vw]">

        <div class="flex flex-col space-y-1 ">
            <div class="px-4 py-3 flex justify-between items-center">
                <div class="">

                    <h4 class="text-lg ">Remove Member</h4>
                </div>
                <button id="closeModel" wire:click="close" class="text-gray-500 w-6 h-6 hover:text-gray-700 text-md focus:outline-none">
                    <x-cross-icon />
                </button>
            </div>

            <hr class="border-gray-400 mt-2" />

            <div class="px-4 pt-3">
                @if (!$this->warning)
                <p>Are you sure to remove <span id="memberName">{{ $user['name'] }}</span> to remove from the
                    <span id = "workshopName">{{ $workspace['name'] }}</span> ?</p>
                @else
                <p>Are you sure to leave from the <span id = "workshopName">{{ $workspace['name'] }}</span> and since no one is in workspace, <span class="text-red-700">workspace will be deleted!!</span></p>
                @endif

            </div>

            <div class="flex items-center justify-between px-4 pt-3">
                <div class=""></div>
                <div class="text-sm">
                    <button id="cancel" wire:click="close" class="bg-gray-600 hover:bg-gray-800 text-white transition-all px-3 py-1 rounded-lg mr-4">
                        Cancel
                    </button>
                    <button id="sure" wire:click.prevent="removeFromWorkspace"  class="bg-red-600 hover:bg-red-800 text-white transition-all px-3 py-1 rounded-lg">
                        <div wire:loading wire:target='removeFromWorkspace' class="animate-spin flex items-center mr-3">
                            <i class="fa-solid fa-spinner"></i>
                        </div>
                        Sure
                    </button>
                </div>
            </div>
        </div>
    </div>

