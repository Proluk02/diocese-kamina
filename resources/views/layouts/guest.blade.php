<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diocèse de Kamina') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:400,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-700 antialiased bg-gray-50 flex flex-col min-h-screen">

    <!-- 1. NAVIGATION (Barre du haut + Menu) -->
    <livewire:public.navigation />

    <!-- 2. CONTENU DYNAMIQUE (Les pages viendront ici) -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- 3. PIED DE PAGE -->
    <livewire:public.footer />

</body>
</html>