<div class="w-full bg-SecondaryBg h-full pt-3">

    <div class="top-bar pl-3 pr-2 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="flex gap-x-2 items-center">
            <img src ="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc35c7t6vW9J0qnXnorC-rqRBCJL2AWgYLJvkS2FE_&s"
            class="w-10 h-10 object-contain" />
            <p>Nova</p>
        </a>
        <div class="">
            <div class="bg-green-300 w-6 h-6 rounded-full ">
            </div>
        </div>
    </div>

    <div class="mt-4 flex flex-col gap-y-5">
        <x-layouts.sidebar-item name="setting" iconClass="fa-solid fa-gear" />
    </div>
</div>
