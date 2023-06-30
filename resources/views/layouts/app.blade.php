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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/datepicker.min.js"></script>

    <link rel="icon" type="image/jpeg" style="object-fit: contain;" href="{{ getLogo() }}"/>
    <!-- Scriptssss -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased" x-data="{
    color: localStorage.getItem('theme') ?? 'light',
    font: localStorage.getItem('font') ?? 'Kanit',
    sidebar: localStorage.getItem('sidebar') ?? false,
}" x-init="{
    color: localStorage.getItem('theme') || 'light',
    font: localStorage.getItem('font') || 'Libre',
    sidebar: localStorage.getItem('sidebar') || false,
}"
x-bind:class="'theme-' + color + ' ' + 'font-' + font" x-cloak>
<div id="loader" class="w-full h-full fixed block top-0 left-0 bg-PrimaryBg  z-80">
    <span class="top-1/3 my-0 mx-auto block relative w-20 h-20">
     <img src="{{ getLogo() }}"  alt="Loading_logo">
    </span>
  </div>
    <div class="min-h-[100vh] overflow-hidden flex font-medium relative ">
       @include('layouts.issue-modal')
        <div :class="sidebar == 'true' ? 'w-[20%] d-block' : 'w-[0%] hidden'" id="sidebar" class="border-r-[1px] transition-all text-PrimaryText bg-PrimaryBg border-SeparateBorder">
            <livewire:layouts.sidebar />
        </div>

        <main class="w-full bg-PrimaryBg text-PrimaryText relative">
            <div class="absolute top-1/3 -left-5 z-[70]">
                <button id="sidebarToggle" class="bg-ButtonBg rounded-full flex items-center justify-center w-10 h-10 ">
                    <i class="fa-solid fa-gears"></i>
                </button>
            </div>
           {{ $slot }}
        </main>

    </div>
    @livewireScripts
    <script>
        window.addEventListener('load', function() {
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', function() {
                $("#test").hide();

                $("#closeIssue").click(function(){
                    $("#test").hide();
                });

            });
    </script>
    @stack('js')
</body>


</html>
