
    <div class="py-12">
        {{-- <p>{{  Session::get('selected_workspace') }}</p> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   @foreach ($workspace->users as $user)
                        <p>{{ $user->name }}</p>

                        <x-user-profile-photo class="w-10 h-10" :user="$user" />
                   @endforeach
                </div>
            </div>
        </div>
    </div>

