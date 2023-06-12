<div class="">
    <div class="">
        <div
            class="text-PrimaryText  border-b-[1px] w-full border-SeparateBorder px-8 flex h-[60px] items-center justify-between sm:px-18">
            <div class="flex space-x-2 items-center">

                <x-user-profile-photo :user="$user" status="true" class="w-6 h-6" />
                <p class="text-sm">{{ $user->name }}</p>

            </div>
        </div>

        <div
            class="text-PrimaryText  border-b-[1px] max-w-full  border-SeparateBorder px-8 flex h-[60px]  items-center sm:px-18">
            <p class="whitespace-pre-wrap break-words w-80">

                <pre>{{ $workspaces }}</pre>
            </p>
        </div>

        <div class="text-PrimaryText w-full  px-8 flex sm:px-18">
            <div class="min-h-screen w-[80%] border-r-[2px] border-SeparateBorder">
                <p>left</p>
            </div>
            <div class="min-h-screen w-[25%] pl-6 py-7">

                <div class="flex space-x-4">
                    <div class="w-16 h-16">
                        <x-user-profile-photo :user="$user" class="w-16 h-16" />
                    </div>
                    <div class="h-full flex flex-col space-y-1 w-4/6">
                        <h3 class="text-lg">{{ $user->name }}</h3>
                        <p class="text-xs text-SecondaryText break-words">{{ $user->email }}</p>
                        @if(auth()->user()->email == $user->email)
                        <a href="{{ route('profile.show',['email' => $user->email]) }}" class="text-xs text-PrimaryText hover:text-HoverText transition" >Edit Profile</a>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col space-y-6 mt-12 text-sm">
                    <div class="flex items-center">
                        <div class="w-3/6">
                            <p class="text-SecondaryText">Online Status</p>
                        </div>
                        <div class="">
                            @if (checkOnline($user))
                            <div class="flex space-x-2 items-center">
                                <p class="">Online</p>
                                <span class="w-3 h-3 rounded-full bg-green-700" ></span>
                            </div>
                            @else
                            <div class="flex space-x-2 items-center">
                                <p class="">Offline</p>
                                <span class="w-3 h-3 rounded-full bg-gray-700" ></span>
                            </div>

                            @endif
                        </div>
                    </div>
                    <x-user-info-item text="User Name " :value="$user->name" />


                    <x-user-info-item text="Joined " :value="$user->created_at->diffForHumans()" />
                </div>
            </div>
        </div>
    </div>
</div>
