<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" :class="{ 'dark': $store.theme.darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diocèse de Kamina') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Gestion du Thème (Dark/Light) sans flash -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = savedTheme === 'dark' || (!savedTheme && prefersDark);
            
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            
            document.addEventListener('alpine:init', () => {
                Alpine.store('theme', {
                    darkMode: isDark,
                    toggle() {
                        this.darkMode = !this.darkMode;
                        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                        if (this.darkMode) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    }
                });
            });
        })();
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 h-full" 
      x-data="{ 
          sidebarExpanded: window.innerWidth >= 1024, 
          sidebarOpen: false
      }" 
      @resize.window="if(window.innerWidth >= 1024) sidebarOpen = false"
      :class="{ 'overflow-hidden': sidebarOpen && window.innerWidth < 1024 }">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="absolute left-0 top-0 z-50 flex h-screen flex-col overflow-y-hidden bg-gradient-to-b from-brand-dark to-gray-900 shadow-2xl transition-all duration-300 ease-in-out lg:static lg:z-auto"
               :class="[
                   sidebarExpanded ? 'w-64' : 'w-20',
                   sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
               ]">
            @include('layouts.partials.sidebar')
        </aside>

        <!-- CONTENU -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden transition-all duration-300">
            
            <livewire:layout.header />

            <main class="flex-1 p-4 md:p-6 2xl:p-10 animate-fadeIn">
                {{ $slot }}
            </main>
            
            <footer class="mt-auto border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-800/50 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Diocèse de Kamina.
            </footer>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm lg:hidden"></div>
</body>
</html>