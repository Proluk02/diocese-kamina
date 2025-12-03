<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diocèse de Kamina') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex flex-col md:flex-row">

        <!-- MOBILE HEADER (Visible uniquement sur petit écran) -->
        <div class="md:hidden bg-brand-dark text-white flex justify-between items-center p-4">
            <div class="font-bold text-xl tracking-wide">KAMINA DASHBOARD</div>
            <button @click="sidebarOpen = !sidebarOpen" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>

        <!-- SIDEBAR (Navigation Gauche - Style KBH) -->
        <!-- La classe md:flex force l'affichage sur desktop, x-show gère le mobile -->
        <aside :class="sidebarOpen ? 'block' : 'hidden'" class="w-full md:w-64 bg-brand-dark text-white md:flex flex-col flex-shrink-0 transition-all duration-300 z-20">
            
            <!-- Logo / Titre -->
            <div class="h-16 flex items-center justify-center border-b border-gray-700 bg-brand-dark shadow-md">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-wider text-white">
                    <span class="text-kamina-gold">DIO</span>CESE
                </a>
            </div>

            <!-- User Info (Optionnel dans la sidebar) -->
            <div class="p-4 border-b border-gray-700 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-gray-500 flex items-center justify-center text-lg font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-brand-accent text-brand-dark font-bold' : 'text-gray-300' }} transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Tableau de bord
                        </a>
                    </li>

                    <!-- MENU ADMIN (Visible seulement pour Admin/Evêque) -->
                    @if(Auth::user()->isAdmin())
                    <li class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mt-4">
                        Administration
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Utilisateurs
                        </a>
                    </li>
                    @endif

                    <!-- MENU EDITORIAL -->
                    <li class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mt-4">
                        Publications
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            Actualités
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Documents
                        </a>
                    </li>

                    <!-- MUSIQUE -->
                    <li class="px-6 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider mt-4">
                        Liturgie
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                            Chants & Partitions
                        </a>
                    </li>

                </ul>
            </nav>
            
            <!-- Logout Button (Bottom Sidebar) -->
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-y-auto h-screen bg-gray-100">
            <!-- Top Header (Blanc, comme KBH) -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
                <!-- Titre de la page dynamique -->
                <h2 class="text-xl font-semibold text-gray-800">
                    @if (isset($header))
                        {{ $header }}
                    @else
                        Tableau de bord
                    @endif
                </h2>

                <!-- Droite du Header -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Bienvenue, {{ Auth::user()->name }}</span>
                    <!-- Vous pourrez ajouter ici les notifications ou autre -->
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>
</html>