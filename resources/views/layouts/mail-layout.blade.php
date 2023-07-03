<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen items-center bg-white text-black">
            <div class="w-3/6 h-[200px] bg-white shadow-lg rounded-lg flex flex-col items-center justify-center">
                    <div class="">
                        <p>{{ $assigner }} created and assigned issue to {{ $receiverEmail }}</p>
                    </div>
                    <a href="{{ $issueUrl }}" class="inline-flex mt-5 items-center px-4 py-2 bg-indigo-600
                    hover:bg-bg-indigo-500
                    border-ButtonBorder rounded-md font-semibold text-white text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150">
                        <span>Go to Issue</span>
                    </a>
            </div>
        </div>
    </body>
</html>
