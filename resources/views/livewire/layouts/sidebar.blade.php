{{-- <div class="absolute w-full h-full bg-gray-600"></div> --}}
<div class="w-full bg-PrimaryBg h-full pt-4 text-PrimaryText">

    <div class="top-bar pl-7 pr-2 flex justify-between items-center">
        @include('components.dropdowns.workspace-dropdown')
        <div class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full border-SecondaryBg transition-all">
            @include('components.dropdowns.profile-dropdown')
        </div>
    </div>

    <div class="flex flex-col  h-[400px] mt-6">
        <div class="my-5 flex pl-4 gap-x-2 w-full">
            <button id="newIssue" class="w-2/3 flex gap-x-1 drop-shadow-md items-center bg-SoftBg rounded-lg text-sm pl-3 pr-2 py-2
            hover:bg-HoverBg hover:text-HoverText transition-all
            ">
                <i class="fa-solid fa-pen-to-square"></i>

                <p>New Issue</p>
            </button>
            <div class="w-1/3 pr-8">
                <a href="{{ route("workspace.search.index",['workspace_name' => $currentWorkspace->name]) }}" class="w-full bg-SoftBg drop-shadow-md  text-sm  rounded-lg all-center h-full
                hover:bg-HoverBg hover:text-HoverText transition-all">
                    <i class="fa-solid fa-search"></i>
                </a>
            </div>
        </div>

        <div class="">
            <a href="{{ route("workspace.setting.member",['workspace_name' => $currentWorkspace->name]) }}" class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-7 pr-2 py-2 mt-2 text-sm">
                <i class="fa-solid fa-users"></i>
                <p>Members</p>
            </a>

            <a href="{{ route("workspace.setting.index",['workspace_name' => $currentWorkspace->name]) }}" class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-7 pr-2 py-2  mt-4 text-sm">
                <i class="fa-solid fa-gear"></i>
                <p>Setting</p>
            </a>

        </div>

    </div>
</div>


@push('js')
    <script>
        $(document).ready(function(){
            $("#newIssue").click(function(){
               $("#test").show()
            });


        })
    </script>
@endpush
