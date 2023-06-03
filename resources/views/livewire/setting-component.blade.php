
<div class="bg-PrimaryBg py-8 px-8 sm:px-24">
    <div class="w-full flex flex-col gap-y-4">

        <div class="w-full flex flex-col">
            <div class="w-full flex flex-col">
                <h3 class="text-2xl">Preferences</h3>
                <p class="text-SecondaryText">Manage your work spaces</p>
            </div>
            <hr class="border-gray-400 my-4" />

            {{-- THEME --}}
            <div class="flex justify-between mt-3">
                <div class="flex flex-col gap-y-1">
                    <h3>Interface Theme</h3>
                    <p class="text-SecondaryText">Select your interface color schema</p>
                </div>
                <div class="text-PrimaryText">
                    <div class="relative inline-block text-left">
                        @include('components.dropdowns.theme-dropdown')
                    </div>
                </div>
            </div>

             {{-- Font --}}
             <div class="flex justify-between mt-7">
                <div class="flex flex-col gap-y-1">
                    <h3>Font Family</h3>
                    <p class="text-SecondaryText">Select your font style interface</p>
                </div>
                <div class="text-PrimaryText">
                    <div class="relative inline-block text-left">
                        @include('components.dropdowns.font-dropdown')
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

