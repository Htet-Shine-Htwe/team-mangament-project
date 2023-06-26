<div class="relative h-[100vh] overflow-y-scroll  pb-6">
    @if (session()->get('status'))
    <x-alert />
    @endif
    <div class="" x-data="{openInvite : false}">
        <header class="text-PrimaryText w-full border-b-[1px] border-SeparateBorder py-3">
            <div class="text-PrimaryText  sm:rounded-lg">
                <div class="sm:px-24 min-w-full">
                    <div class="min-w-full relative rounded-md text-sm ">
                        <input type="text" class="min-w-full search-bar rounded-md h-10 pl-10 !bg-HoverBg border-PrimaryBg">
                        <i class="fa-solid fa-search absolute left-4 top-1/2 transform -translate-y-1/2"></i>
                    </div>
                </div>
            </div>
        </header>

        {{--        *******************  Get Member Lists *******************  --}}
        <div class=" w-full ">
            <div class=" sm:rounded-lg">
                <div class="px-8 pb-4 sm:px-24">
                    <div class="w-full flex flex-col">
                        <h3 class="text-xl">Manage Members</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
