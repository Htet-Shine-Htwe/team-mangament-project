<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Nova') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/f39d469662.js" crossorigin="anonymous"></script>

        <!-- Scriptssss -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased "
    x-data="{ color: localStorage.getItem('theme') || 'light',font: localStorage.getItem('font') || 'Libre' }"
    x-init="{ color: localStorage.getItem('theme') || 'light',font: localStorage.getItem('font') || 'Libre' }"
    x-bind:class="'theme-' +color + ' ' + 'font-' + font" x-cloak>

        <div class="min-h-screen flex ">
            <div class="w-[20%] border-r-2 text-PrimaryText bg-PrimaryBg border-gray-100">
                @include('layouts.sidebar')
            </div>
            <main class="w-full bg-PrimaryBg text-PrimaryText">
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
