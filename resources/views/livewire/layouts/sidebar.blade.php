<div class="w-full bg-PrimaryBg h-full pt-4 text-PrimaryText">

    <div class="top-bar pl-5 pr-2 flex justify-between items-center">
        @include('components.dropdowns.workspace-dropdown')
        <div class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full border-SecondaryBg transition-all">
            @include('components.dropdowns.profile-dropdown')
        </div>
    </div>

    <div class="flex flex-col justify-between h-[400px] mt-6">
        <div class="">
            <a href="{{ route("workspace.setting.member",['workspace_name' => $currentWorkspace->name]) }}" class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-5 pr-2 py-2 mt-2 text-sm">
                <i class="fa-solid fa-users"></i>
                <p>Members</p>
            </a>

            <a href="{{ route("workspace.setting.index",['workspace_name' => $currentWorkspace->name]) }}" class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-5 pr-2 py-2  mt-4 text-sm">
                <i class="fa-solid fa-gear"></i>
                <p>Setting</p>
            </a>

        </div>

        <div class="">
            <p>Botton</p>
        </div>
    </div>
</div>


@push('js')
    <script>
        $(document).ready(function(){
            $('img').lazyload();
        })
    </script>
@endpush
