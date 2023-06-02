<div x-show="crop" x-transition class="min-w-full min-h-[100vh] absolute flex items-center justify-center">
   <div @click.away="crop = false" class="pb-7 bg-SoftBg z-90 border-SeparateBorder rounded-lg border-[1px]">
    <div class="flex flex-col space-y-4">

        <div class="py-4 border-b-2 border-SeparateBorder flex justify-between px-8 ">
            <p class="text-sm font-medium">Adjust Your Avatar</p>

            <button x-on:click="crop = false" @click="close"
            class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <x-cross-icon/>
            </button>

        </div>

        <div wire:ignore class="w-full px-12 border-b-2 border-SeparateBorder  pb-2">
            <div class=""  id="upload-demo">

            </div>
        </div>

        <div class="pt-4 flex justify-center items-center px-8 ">
            <button id="saveCropped" class="bg-ButtonBg hover:bg-ButtonFocus w-full rounded-md py-3 ">
                Save Profile Photo
            </button>
        </div>
    </div>
   </div>
</div>
