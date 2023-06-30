<div class="relative  bg-PrimaryBg rounded-lg shadow ">
    <!-- Modal header -->
    <div class="flex items-start justify-between px-7 py-4 border-b  border-SeparateBorder rounded-t ">
        <h3 class="text-xl font-semibold">
            Create Issue
        </h3>
        <div class="flex gap-x-2">
            <button wire:click='fullScreen'
                class="cursor-pointer bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all hover:scale-150"
                data-modal-hide="defaultModal">
                <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                <span class="sr-only">Full Screen</span>
            </button>
            <button id="closeIssue" type="button"
                class="cursor-pointer bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all hover:scale-150"
                data-modal-hide="defaultModal">
                <i class="fa-solid fa-xmark"></i>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

    </div>
    <!-- Modal body -->
    <div class="px-6 py-2 ">
        <div class="text-PrimaryText">
            <form id="modalIssue" wire:submit.prevent='submit'></form>
            <div class="flex flex-col gap-y-1">
                <input wire:model.lazy="title" type="text" placeholder="Issue title" class="border-full-none" required>

                @if ($errors->has('title'))
                    <p class="text-red-500 text-xs">{{ $errors->first('title') }}</p>
                @endif
                <div wire:model.lazy="description" class="mt-1">
                    <textarea placeholder="Add a description .." required
                        class="border-none w-full font-normal focus:outline-none focus:ring-0 focus:border-none hover:outline-none hover:ring-0 bg-PrimaryBg min-h-[80px] max-h-[300px] resize-y overflow-y-scroll"></textarea>
                </div>
                @if ($errors->has('description'))
                    <p class="text-red-500 text-xs">{{ $errors->first('description') }}</p>
                @endif

                <div class="flex gap-x-2 items-center">
                    <div class=" ">
                        <livewire:issues.tags.status-index :currentStatus="$status" />
                    </div>

                    <div class="">
                        <livewire:issues.tags.assign-index :currentAssign="$assign" />

                    </div>

                    <div class="">
                        <livewire:issues.tags.due-index :index="1" />
                    </div>
                </div>
            </div>

            <hr class="border-[1px] border-SeparateBorder mt-3">

            <div class="pt-6 pb-4 flex justify-between items-center">
                <div class="">

                </div>
                <button form="modalIssue" type="submit" class="primary-btn ">
                    <div wire:loading wire:target='submit' class="animate-spin flex items-center ml-4">
                        <i class="fa-solid fa-spinner"></i>
                    </div>
                    <p>Create</p>
                </button>
            </div>
        </div>

    </div>
    <!-- Modal footer -->

</div>



