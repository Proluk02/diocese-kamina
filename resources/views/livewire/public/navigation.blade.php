<div class="w-full z-50 font-sans fixed top-0 transition-all duration-300" 
     x-data="{ mobileMenuOpen: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-lg py-0' : 'bg-transparent py-2'">
    
    <!-- TOP BAR (Disparaît au scroll pour épurer) -->
    <div class="bg-kamina-blue dark:bg-blue-900 text-white text-xs border-b border-blue-800 transition-all duration-300 overflow-hidden"
         :class="scrolled ? 'h-0 opacity-0' : 'h-10 opacity-100 py-2'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-full">
            <div class="flex items-center gap-6">
                <a href="tel:+243999000000" class="flex items-center gap-1.5 hover:text-kamina-gold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <span>Secrétariat</span>
                </a>
                <a href="mailto:contact@diocesekamina.org" class="hidden sm:flex items-center gap-1.5 hover:text-kamina-gold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>contact@diocesekamina.org</span>
                </a>
            </div>
            @auth
                <a href="{{ route('dashboard') }}" class="text-xs bg-white/10 hover:bg-white/20 px-3 py-1 rounded-full transition">Retour Admin</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-kamina-gold transition font-medium">Espace Membres</a>
            @endauth
        </div>
    </div>

    <!-- MAIN NAVBAR -->
    <nav class="w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-300" :class="scrolled ? 'h-16' : 'h-20'">
                
                <!-- LOGO -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="relative">
                            <div class="h-10 w-10 bg-kamina-blue text-white rounded-xl flex items-center justify-center font-bold text-xl group-hover:bg-kamina-gold transition-colors duration-300 shadow-md">DK</div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold leading-none tracking-wide font-playfair transition duration-300" 
                                  :class="scrolled ? 'text-gray-900 dark:text-white' : 'text-gray-900 dark:text-white'">
                                DIOCÈSE
                            </span>
                            <span class="text-[10px] font-bold tracking-[0.25em] uppercase text-gray-500">de Kamina</span>
                        </div>
                    </a>
                </div>

                <!-- DESKTOP MENU -->
                <div class="hidden md:flex space-x-1 items-center">
                    
                    @foreach([
                        ['label' => 'Accueil', 'route' => 'home'],
                        ['label' => 'Actualités', 'route' => 'news.index'],
                    ] as $item)
                        <a href="{{ route($item['route']) }}" 
                           class="px-4 py-2 text-sm font-semibold rounded-full transition-colors {{ request()->routeIs($item['route'].'*') ? 'text-kamina-blue bg-blue-50 dark:bg-blue-900/30 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                           {{ $item['label'] }}
                        </a>
                    @endforeach

                    <!-- Dropdown "Le Diocèse" -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-4 py-2 text-sm font-semibold rounded-full transition-colors text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800">
                            Le Diocèse
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-transition.opacity.duration.200ms class="absolute left-0 mt-0 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 py-2 z-50">
                            <a href="{{ route('presentation') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-kamina-blue">Présentation & Évêque</a>
                            <a href="{{ route('documents.public.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-kamina-blue">Médiathèque</a>
                            <a href="{{ route('contact') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-kamina-blue">Nous Contacter</a>
                        </div>
                    </div>

                    <!-- Autres liens -->
                    <a href="{{ route('parishes.public.index') }}" class="px-4 py-2 text-sm font-semibold rounded-full transition-colors text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800">Paroisses</a>
                    <a href="{{ route('liturgy.public.index') }}" class="px-4 py-2 text-sm font-semibold rounded-full transition-colors text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800">Liturgie</a>

                    <!-- Separator -->
                    <div class="h-6 w-px bg-gray-200 dark:bg-gray-700 mx-2"></div>

                    <!-- Dark Mode Toggle -->
                    <button @click="toggleTheme()" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition">
                        <!-- Soleil -->
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <!-- Lune -->
                        <svg x-show="darkMode" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>

                    <!-- CTA Don -->
                    <a href="{{ route('donation') }}" class="ml-2 flex items-center gap-2 bg-kamina-gold hover:bg-yellow-600 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Don
                    </a>
                </div>

                <!-- MOBILE BURGER -->
                <div class="flex items-center gap-4 md:hidden">
                    <button @click="toggleTheme()" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg x-show="darkMode" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 dark:text-gray-300 hover:text-kamina-blue p-2 focus:outline-none">
                        <svg class="h-7 w-7" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="h-7 w-7" x-show="mobileMenuOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div x-show="mobileMenuOpen" x-collapse class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 shadow-xl absolute w-full z-50">
            <div class="px-4 pt-4 pb-8 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-kamina-blue dark:bg-blue-900/30 dark:text-blue-300' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">Accueil</a>
                <a href="{{ route('news.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800">Actualités</a>
                <div class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider mt-4">Le Diocèse</div>
                <a href="{{ route('presentation') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 ml-2 border-l-2 border-gray-200 dark:border-gray-700">Présentation</a>
                <a href="{{ route('documents.public.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 ml-2 border-l-2 border-gray-200 dark:border-gray-700">Médiathèque</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 ml-2 border-l-2 border-gray-200 dark:border-gray-700">Contact</a>
                <div class="border-t border-gray-100 dark:border-gray-800 my-4"></div>
                <a href="{{ route('parishes.public.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800">Paroisses</a>
                <a href="{{ route('liturgy.public.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800">Liturgie</a>
                <a href="{{ route('donation') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-kamina-gold bg-yellow-50 dark:bg-yellow-900/20 text-center mt-4">Faire un Don</a>
            </div>
        </div>
    </nav>
</div>