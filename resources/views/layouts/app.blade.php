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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="croppie.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="icon" type="image/jpeg" style="object-fit: contain;" href="{{ getLogo() }}"/>
    <!-- Scriptssss -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased" x-data="{ color: localStorage.getItem('theme') || 'light', font: localStorage.getItem('font') || 'Kanit' }" x-init="{ color: localStorage.getItem('theme') || 'light', font: localStorage.getItem('font') || 'Libre' }"
    x-bind:class="'theme-' + color + ' ' + 'font-' + font" x-cloak>
    <div class="min-h-[100vh] overflow-hidden flex  font-medium">
        <div class="w-[20%] border-r-[1px] text-PrimaryText bg-PrimaryBg border-SeparateBorder">
            <livewire:layouts.sidebar />
        </div>
        <main class="w-full bg-PrimaryBg text-PrimaryText">
           {{ $slot }}
        </main>
    </div>
    @livewireScripts

    @stack('js')
</body>

</html>
