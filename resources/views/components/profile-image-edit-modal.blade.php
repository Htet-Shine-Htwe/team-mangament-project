<div id="cropModel" wire:ignore class="min-w-full min-h-[100vh] absolute flex items-center justify-center transition-all">
   <div id="cropInnerModel" class="pb-7 bg-SoftBg z-90 border-SeparateBorder rounded-lg border-[1px]">
    <div class="flex flex-col space-y-4">

        <div class="py-4 border-b-2 border-SeparateBorder flex justify-between px-8 ">
            <p class="text-sm font-medium">Adjust Your Avatar</p>

            <button id="closeModel"
            class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <x-cross-icon/>
            </button>

        </div>

        <div wire:ignore class="w-full px-12 border-b-2 border-SeparateBorder  pb-2">
            <div class=""  id="upload-demo">

            </div>
        </div>

        <div class="pt-4 flex justify-center items-center px-8 ">
            <button id="saveCropped"  wire:loading.attr="disabled" class="inline-flex items-center w-60 py-2 bg-ButtonBg
            hover:bg-ButtonFocus justify-center
            border-ButtonBorder rounded-md font-semibold text-xs text-white  uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150 space-x-2
            disabled:bg-indigo-800 ">
                <div wire:loading="logo" class="animate-spin flex items-center">
                    <i class="fa-solid fa-spinner"></i>
                </div>
                <p>Save Profile Photo</p>

            </button>
        </div>
    </div>
   </div>
</div>
