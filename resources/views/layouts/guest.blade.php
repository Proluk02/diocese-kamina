<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Diocèse de Kamina') }}</title>
    <meta name="description" content="{{ $description ?? 'Site officiel du Diocèse de Kamina.' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair-display:400,600,700,800&display=swap" rel="stylesheet" />

    <!-- AOS & Leaflet -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SCRIPT DE PERSISTANCE (Crucial pour wire:navigate) -->
    <script>
        // Fonction pour appliquer le thème
        function applyTheme() {
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        // 1. Exécuter immédiatement au chargement initial
        applyTheme();

        // 2. Initialiser le Store Alpine
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                darkMode: localStorage.getItem('theme') === 'dark',
                toggle() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                    applyTheme();
                }
            });
        });

        // 3. Ré-appliquer à chaque navigation Livewire
        document.addEventListener('livewire:navigated', () => {
            applyTheme();
        });
    </script>
</head>

<body class="font-sans text-slate-600 dark:text-gray-300 antialiased bg-brand-light dark:bg-gray-900 flex flex-col min-h-screen"
      x-data="{ scrolled: false }" 
      @scroll.window="scrolled = (window.pageYOffset > 40)">

    <!-- Navigation -->
    <livewire:public.navigation />

    <!-- Contenu -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <livewire:public.footer />

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            AOS.init({ duration: 800, once: true });
        });
    </script>
</body>
</html>