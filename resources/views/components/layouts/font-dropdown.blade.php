<div class="relative" x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
        class="flex items-center">
        <p>Select Font</p>
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
            <button value="Sans" class="font-switch w-full font-Sans flex hover:cursor-pointer px-4 py-1 hover:bg-HoverBg hover:text-HoverText ">
                <i></i>
                <p>Sans</p>
            </button>
        </li>
        <li class="flex gap-x-8 items-start mt-3">
            <button value="Pt" class="font-switch w-full font-Pt flex hover:cursor-pointer px-4 py-1  hover:bg-HoverBg hover:text-HoverText">
                <i></i>
                <p class="">PT</p>
            </button>
        </li>
        <li class="flex gap-x-8 items-start mt-3">
            <button value="Libre" class="font-switch font-Libre w-full flex hover:cursor-pointer px-4 py-1  hover:bg-HoverBg hover:text-HoverText">
                <i></i>
                <p class="">Libre</p>
            </button>
        </li>
        <li class="flex gap-x-8 items-start mt-3">
            <button value="kanit" class="font-switch font-kanit w-full flex hover:cursor-pointer px-4 py-1  hover:bg-HoverBg hover:text-HoverText">
                <i></i>
                <p class="">Kanit</p>
            </button>
        </li>

    </ul>
</div>
