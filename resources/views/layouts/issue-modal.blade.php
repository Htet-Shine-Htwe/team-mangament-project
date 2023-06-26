<div id="test" class="absolute w-full h-full flex justify-center items-start pt-20 bg-gray-600 bg-opacity-70 z-[100]">
    <!-- Main modal -->
    <div id="defaultModal" class="z-50 w-3/6 p-4 ">
        <div class="relative ">
            <!-- Modal content -->
            <div class="relative  bg-PrimaryBg rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-start justify-between px-7 py-4 border-b  border-SeparateBorder rounded-t ">
                    <h3 class="text-xl font-semibold">
                        Create Issue
                    </h3>
                    <div class="flex gap-x-2">
                        <a href="{{ route('workspace.issue.create',['workspace_name' => getCurrentWorkspaceName()]) }}"
                        class="cursor-pointer bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all hover:scale-150"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                        <span class="sr-only">Full Screen</span>
                         </a>
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
                    <livewire:issues.model.index />
                </div>
                <!-- Modal footer -->

            </div>
        </div>
    </div>

</div>
