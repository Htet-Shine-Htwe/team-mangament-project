{{-- this is full screen view page  --}}
<div class="">
    <form id="modalIssue" action="submit"></form>
    <div class="flex flex-col gap-y-1">
        <input type="text" placeholder="Issue title"
            class="border-full-none">

        <div class="mt-1">
            <textarea placeholder="Add a description .."
                class="border-none w-full font-normal focus:outline-none focus:ring-0 focus:border-none hover:outline-none hover:ring-0 bg-PrimaryBg min-h-[80px] max-h-[300px] resize-y overflow-y-scroll"></textarea>
        </div>


        <div class="flex gap-x-2 items-center">
            <div class=" ">
                <livewire:issues.tags.status-index :currentStatus="$status" />
            </div>

            <div class="dropdown ">
                <button class="m-1 ">
                    <div class="flex gap-x-1 items-center bg-gray-300 rounded-lg ">
                        <i class="fa-solid fa-tag"></i>
                        <span>status</span>
                    </div>
                </button>
                <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                    <li><a>Item 1</a></li>
                    <li><a>Item 2</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
