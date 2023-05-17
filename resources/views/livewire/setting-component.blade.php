<div class="bg-PrimaryBg py-12 px-14">
    <div class="w-full flex flex-col gap-y-4">
        <div class="w-full flex flex-col">
            <h3 class="text-2xl">Workspaces</h3>
            <p class="text-SecondaryText">Manage your work spaces</p>
        </div>

        <hr class="border-gray-400" />
        <div class="w-full flex flex-col">
            <div class="w-full flex flex-col">
                <h3 class="text-2xl">Preferences</h3>
                <p class="text-SecondaryText">Manage your work spaces</p>
            </div>
            <hr class="border-gray-400 my-4" />

            {{-- THEME --}}
            <div class="flex justify-between">
                <div class="flex flex-col gap-y-1">
                    <h3>Interface Theme</h3>
                    <p class="text-SecondaryText">Select your interface color schema</p>
                </div>

                <div class="text-PrimaryText">
                    <div class="relative inline-block text-left">
                        <div class="relative" x-data="{ isOpen: false }">
                            <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                class="flex items-center">
                                <p>Select Theme</p>
                                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="24" height="24">
                                    <path
                                        d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"
                                        class="heroicon-ui"></path>
                                </svg>
                            </button>
                            <ul x-show="isOpen" @click.away="isOpen = false" x-cloak
                                class="absolute font-normal bg-SoftBg shadow overflow-hidden rounded w-36 border mt-2 py-3 right-0 z-20">
                                <li class="flex gap-x-8 items-start">
                                    <button value="dark" class="theme-switch w-full flex hover:cursor-pointer px-4 py-1 hover:bg-HoverBg hover:text-HoverText ">
                                        <i></i>
                                        <p>Dark</p>
                                    </button>
                                </li>
                                <li class="flex gap-x-8 items-start mt-3">
                                    <button value="light" class="theme-switch w-full flex hover:cursor-pointer px-4 py-1  hover:bg-HoverBg hover:text-HoverText">
                                        <i></i>
                                        <p class="">Light</p>
                                    </button>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

