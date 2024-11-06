<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Lita Surya</title>
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>

    @vite(['resources/sass/app.scss', 'resources/css/style.scss', 'resources/js/app.js'])
    @livewireStyles
    <!-- CSRF Token -->

</head>
<body class="bg-background">
<x-navigation.sidebar.wrapper>
    <x-navigation.sidebar.item
        title="Dashboard"
        to="/dashboard"
        materialIcon="dashboard"
    ></x-navigation.sidebar.item>
    <x-navigation.sidebar.item-tree
        title="Master Data"
        to="/dashboard"
        materialIcon="database"
    >
        <x-navigation.sidebar.item
            title="Dashboard"
            to="/dashboard"
            materialIcon="dashboard"
        ></x-navigation.sidebar.item>
        <x-navigation.sidebar.item
            title="Dashboard"
            to="/dashboard"
            materialIcon="dashboard"
        ></x-navigation.sidebar.item>
    </x-navigation.sidebar.item-tree>
    <x-navigation.sidebar.item
        title="Dashboard"
        to="/dashboard"
        materialIcon="dashboard"
    ></x-navigation.sidebar.item>
</x-navigation.sidebar.wrapper>
{{ $slot }}

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@livewireScripts
</body>
</html>
