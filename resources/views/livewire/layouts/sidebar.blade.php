<div class="w-full bg-PrimaryBg h-full pt-4 text-PrimaryText">

    <div class="top-bar pl-5 pr-2 flex justify-between items-center">
        @include('components.dropdowns.workspace-dropdown')
        <div class="hover:ring-indigo-500 hover:border-indigo-500 border-2 rounded-full border-SecondaryBg transition-all">
            @include('components.dropdowns.profile-dropdown')
        </div>
    </div>

    <div class="flex flex-col justify-between h-[400px] items-">
        <div class="">
            <p>Top</p>
        </div>

        <div class="">
            <p>Botton</p>
        </div>
    </div>
</div>
