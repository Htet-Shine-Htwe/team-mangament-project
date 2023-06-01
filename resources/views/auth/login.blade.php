<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="flex items-center justify-center mb-6 ">
            <h3 class="text-2xl font-semibold text-PrimaryText">Log in to Hydra Bird</h3>
        </div>

        <div class="flex flex-col gap-y-8 ">
            <a href="{{ route('social.login','google') }}" class="flex gap-x-3 items-center font-medium justify-center w-full cursor-pointer px-4 py-4 bg-ButtonBg text-white rounded-lg hover:bg-ButtonFocus hover:text-HoverText transition">
                <i class="fa-brands fa-google"></i>
                <p>{{ __('Sign in with Google') }}</p>
            </a>
            <a href="login/github" class="flex gap-x-3 items-center font-medium justify-center w-full cursor-pointer px-4 py-4 bg-ButtonBg rounded-lg hover:bg-ButtonFocus text-white hover:text-HoverText transition">
                <i class="fa-brands fa-github"></i>
                <p>{{ __('Sign in with Github') }}</p>
            </a>
        </div>


</x-guest-layout>
