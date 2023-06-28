<div class="relative flex  h-full bg-PrimaryBg rounded-lg w-full shadow pb-10">
    <!-- Modal header -->
    <div class="w-4/5 border-r-[1px] border-SeparateBorder h-full ">
        <div class="flex items-start justify-between px-7 py-6 border-b  border-SeparateBorder rounded-t ">
            <h3 class="pl-24 pr-12  text-xl font-semibold">
                Create Issue
            </h3>

            <div class="flex gap-x-6 items-center">
                <div class="mr-2">
                    <button id="attachFile" class="w-full h-full flex items-center">
                        <i class="fa-solid fa-paperclip"></i>
                    </button>
                    <input wire:model="fileUpload"  multiple type="file" id="fileUpload" class="hidden"
                    accept=".jpe,.jpg,.jpeg,.png,.xml,.pdf,.csv"/>
                </div>
                <div class="border-r-[1px] border-SeparateBorder pr-5">
                     <button class="w-full h-full flex items-center">
                        <i class="fa-solid fa-ellipsis"></i>
                     </button>
                </div>

                <div class="w-full h-full flex items-center">
                        <a href="{{ route('dashboard') }}">Cancel</a>
                </div>

                <div wire:click="createIssue" class="flex items-center w-full h-full">
                    <button class="primary-btn">Save</button>
                </div>
            </div>
        </div>
        <!-- Modal body -->
        <div class="px-6 ">
            {{-- this is full screen view page  --}}
            <div class="">
                <form id="modalIssue" action="submit"></form>
                <div class=" pl-24 pr-12 flex flex-col gap-y-1 ">
                    <input type="text" wire:model.defer="title"  placeholder="Issue title" class="border-full-none">

                    @if ($errors->has('title'))
                    <p class="text-red-500 text-xs">{{ $errors->first('title') }}</p>
                    @endif

                    <div class="mt-1">
                    <textarea wire:model.defer="description" placeholder="Add a description .."
                            class="border-none w-full font-normal focus:outline-none focus:ring-0 focus:border-none hover:outline-none hover:ring-0 bg-PrimaryBg min-h-[280px] resize-y overflow-y-scroll"></textarea>
                            {{-- BBAN-179 --}}
                        </div>
                     @if ($errors->has('description'))
                        <p class="text-red-500 text-xs">{{ $errors->first('description') }}</p>
                    @endif


                    <div class="mt-4 flex flex-col items-center gap-y-4 w-5/6 h-5/6">

                        @if ($fileUpload)

                        @foreach ($fileUpload as $file)
                        <img class="" src="{{ $file->temporaryUrl() }}">
                        @endforeach
                        @endif
                    </div>

                </div>
                <div wire:loading wire:target='fileUpload' class="animate-spin  mt-4">
                    <i class="fa-solid fa-spinner"></i>
                </div>

            </div>

        </div>
    </div>

    <div class="flex flex-col w-1/5 items-center">

        <div class="flex flex-col w-full h-full  space-y-6 mt-12 text-md pl-10">

            <div class="flex items-center w-full">
                <div class="w-2/6">
                    <p class="text-SecondaryText">Status</p>
                </div>
                <div class="">
                    <livewire:issues.tags.status-index :currentStatus="$status" />
                </div>
            </div>

            <div class="flex items-center w-full">
                <div class="w-2/6">
                    <p class="text-SecondaryText">Assign</p>
                </div>
                <div class="">
                    <livewire:issues.tags.assign-index  :currentAssign="$assign" />
                </div>
            </div>
        </div>
    </div>
    <!-- Modal footer -->

</div>

@push('js')
    <script>
         document.addEventListener('DOMContentLoaded', function() {
                $("#attachFile").click(function()
                {
                    $("#fileUpload").click();
                })

            });
    </script>
@endpush
