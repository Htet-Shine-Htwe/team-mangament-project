
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
                <p>Are you sure to remove <span id="memberName">{{ $user['name'] }}</span> to remove from the
                    <span id = "workshopName">{{ $workspace['name'] }}</span> ?</p>
            </div>

            <div class="flex items-center justify-between px-4 pt-3">
                <div class=""></div>
                <div class="text-sm">
                    <button id="cancel" class="bg-gray-600 hover:bg-gray-800 text-white transition-all px-3 py-1 rounded-lg mr-4">
                        Cancel
                    </button>
                    <button id="sure" class="bg-red-600 hover:bg-red-800 text-white transition-all px-3 py-1 rounded-lg">
                        Sure
                    </button>
                </div>
            </div>
        </div>
    </div>

