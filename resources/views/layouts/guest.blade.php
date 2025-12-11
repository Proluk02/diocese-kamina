<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diocèse de Kamina') }}</title>

    <!-- Fonts : Inter (Corps) & Playfair Display (Titres) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair-display:400,600,700,800&display=swap" rel="stylesheet" />

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script Dark Mode (Anti-flash au chargement) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<!-- 
    MODIFICATION ICI : 
    Remplacement de 'bg-gray-50' par 'bg-brand-light' pour un fond plus doux 
    Ajout de 'text-slate-600' pour un texte moins noir (plus lisible)
-->
<body class="font-sans text-slate-600 dark:text-gray-300 antialiased bg-brand-light dark:bg-gray-900 flex flex-col min-h-screen transition-colors duration-300"
      x-data="{ 
          darkMode: localStorage.getItem('theme') === 'dark',
          toggleTheme() {
              this.darkMode = !this.darkMode;
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
                  localStorage.setItem('theme', 'dark');
              } else {
                  document.documentElement.classList.remove('dark');
                  localStorage.setItem('theme', 'light');
              }
          }
      }">

    <!-- Navigation -->
    <livewire:public.navigation />

    <!-- Contenu -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <livewire:public.footer />

    <!-- AOS Script (Animations) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>