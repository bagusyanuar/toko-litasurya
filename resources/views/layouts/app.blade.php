<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Lita Surya</title>
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>

    @vite(['resources/sass/app.scss', 'resources/css/style.scss', 'resources/js/app.js'])
    @livewireStyles
    <!-- CSRF Token -->

</head>
<body class="bg-neutral-100">
<x-navigation.sidebar.wrapper>

</x-navigation.sidebar.wrapper>
{{ $slot }}

@livewireScripts
</body>
</html>
