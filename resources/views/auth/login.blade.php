<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="flex flex-col gap-y-8 ">
            <a href="{{ route('social.login','google') }}" class="flex gap-x-3 items-center font-medium justify-center w-full cursor-pointer px-4 py-4 bg-SoftBg rounded-lg hover:bg-HoverBg hover:text-HoverText transition">
                <i class="fa-brands fa-google"></i>
                <p>{{ __('Sign in with Google') }}</p>
            </a>
            <a href="login/github" class="flex gap-x-3 items-center font-medium justify-center w-full cursor-pointer px-4 py-4 bg-SoftBg rounded-lg hover:bg-HoverBg hover:text-HoverText transition">
                <i class="fa-brands fa-github"></i>
                <p>{{ __('Sign in with Github') }}</p>
            </a>
        </div>


</x-guest-layout>
