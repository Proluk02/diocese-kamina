<!-- Wrapper Principal Fixe -->
<header x-data="{ mobileMenuOpen: false }" 
        :class="scrolled ? 'translate-y-0 shadow-lg' : ''"
        class="fixed top-0 w-full z-50 transition-all duration-500">
    
    <!-- Arrière-plan dynamique (Glassmorphism) -->
    <div class="absolute inset-0 transition-all duration-500 -z-10"
         :class="scrolled 
            ? 'bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-slate-200/50 dark:border-white/10' 
            : 'bg-transparent'">
    </div>

    <!-- 1. TOP BAR (Contact & Identification) -->
    <div class="overflow-hidden transition-all duration-500 ease-in-out"
         :class="scrolled ? 'max-h-0 opacity-0' : 'max-h-12 opacity-100 border-b border-white/10'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2.5 flex justify-between items-center text-[11px] font-bold tracking-wide uppercase">
            
            <!-- Contact Info -->
            <div class="flex gap-6">
                @if(!empty($S['contact_phone']))
                <a href="tel:{{ $S['contact_phone'] }}" class="flex items-center gap-2 text-white/90 hover:text-kamina-gold transition-colors">
                    <svg class="w-3.5 h-3.5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ $S['contact_phone'] }}
                </a>
                @endif
                
                @if(!empty($S['contact_email']))
                <a href="mailto:{{ $S['contact_email'] }}" class="hidden sm:flex items-center gap-2 text-white/90 hover:text-kamina-gold transition-colors border-l border-white/20 pl-6">
                    <svg class="w-3.5 h-3.5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ $S['contact_email'] }}
                </a>
                @endif
            </div>

            <!-- Identification Section -->
            <div class="flex gap-4 items-center">
                @auth
                    @if(auth()->user()->role !== 'user')
                        <!-- Bouton ADMIN pour les gestionnaires -->
                        <a href="{{ route('dashboard') }}" class="bg-kamina-blue text-white px-3 py-1 rounded text-[10px] font-black tracking-widest hover:bg-blue-700 transition-all shadow-md">
                            ADMIN
                        </a>
                    @else
                        <!-- Simple TEXTE pour les fidèles (Aucun lien) -->
                        <span class="flex items-center gap-2 text-white font-black tracking-widest text-[10px]">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            {{ auth()->user()->name }}
                        </span>
                    @endif
                @else
                    <!-- Lien Connexion pour les visiteurs -->
                    <a href="{{ route('login') }}" class="text-white/90 hover:text-kamina-gold transition-colors flex items-center gap-1.5 font-bold">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                        ESPACE MEMBRES
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- 2. NAVBAR PRINCIPALE -->
    <nav class="relative transition-all duration-300" :class="scrolled ? 'py-1' : 'py-3'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- LOGO -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                        <div class="relative transition-transform duration-500 group-hover:scale-105" :class="scrolled ? 'scale-90' : 'scale-100'">
                            <div class="h-12 w-12 rounded-xl flex items-center justify-center font-serif text-2xl shadow-xl transition-all duration-300 border border-slate-100 dark:border-transparent"
                                 :class="scrolled || !$store.theme.darkMode ? 'bg-kamina-blue text-white' : 'bg-white text-kamina-blue'">
                                <span class="tracking-tighter font-bold">DK</span>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-kamina-gold rounded-full border-2 border-white dark:border-gray-900"></div>
                        </div>
                        <div class="flex flex-col border-l border-white/20 pl-4 transition-colors duration-300" :class="scrolled ? 'border-slate-200 dark:border-gray-700' : 'border-white/20'">
                            <span class="text-xl font-extrabold font-playfair tracking-tight"
                                  :class="scrolled || !$store.theme.darkMode ? 'text-slate-900 dark:text-white' : 'text-white'">
                                DIOCÈSE
                            </span>
                            <span class="text-[10px] font-bold tracking-[0.3em] uppercase"
                                  :class="scrolled || !$store.theme.darkMode ? 'text-kamina-gold' : 'text-white/70'">
                                de {{ $S['site_name'] ?? 'Kamina' }}
                            </span>
                        </div>
                    </a>
                </div>

                <!-- DESKTOP MENU -->
                <div class="hidden lg:flex items-center space-x-1">
                    @foreach([
                        ['label' => 'Accueil', 'route' => 'home'],
                        ['label' => 'Actualités', 'route' => 'news.index'],
                        ['label' => 'Paroisses', 'route' => 'parishes.public.index'],
                        ['label' => 'Liturgie', 'route' => 'liturgy.public.index']
                    ] as $item)
                        <a href="{{ route($item['route']) }}" wire:navigate
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300"
                           :class="scrolled 
                            ? ({{ request()->routeIs($item['route'].'*') ? 'true' : 'false' }} ? 'text-kamina-blue bg-blue-50 dark:bg-blue-900/40' : 'text-slate-700 dark:text-gray-300 hover:text-kamina-blue hover:bg-slate-100 dark:hover:bg-gray-800')
                            : ({{ request()->routeIs($item['route'].'*') ? 'true' : 'false' }} ? 'text-white bg-white/20' : 'text-white/90 hover:text-white hover:bg-white/10')">
                           {{ $item['label'] }}
                        </a>
                    @endforeach

                    <!-- Plus Dropdown -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-4 py-2 text-sm font-bold rounded-full transition-all duration-300"
                                :class="scrolled || !$store.theme.darkMode ? 'text-slate-700 dark:text-gray-300 hover:bg-slate-100' : 'text-white/90 hover:text-white hover:bg-white/10'">
                            Plus
                            <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-cloak x-transition class="absolute right-0 mt-1 w-56 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-slate-100 dark:border-gray-700 py-2 z-50">
                            <a href="{{ route('presentation') }}" wire:navigate class="block px-5 py-2.5 text-sm font-bold text-slate-700 dark:text-gray-200 hover:bg-slate-50 dark:hover:bg-gray-700 hover:text-kamina-blue transition-colors">Présentation</a>
                            <a href="{{ route('documents.public.index') }}" wire:navigate class="block px-5 py-2.5 text-sm font-bold text-slate-700 dark:text-gray-200 hover:bg-slate-50 dark:hover:bg-gray-700 hover:text-kamina-blue transition-colors">Documents Officiels</a>
                            <a href="{{ route('contact') }}" wire:navigate class="block px-5 py-2.5 text-sm font-bold text-slate-700 dark:text-gray-200 hover:bg-slate-50 dark:hover:bg-gray-700 hover:text-kamina-blue transition-colors">Contact</a>
                        </div>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <button @click="$store.theme.toggle()" class="p-2.5 rounded-xl transition-all"
                            :class="scrolled || !$store.theme.darkMode ? 'text-slate-600 hover:bg-slate-100 dark:text-gray-400 dark:hover:bg-gray-800' : 'text-white/80 hover:bg-white/10'">
                        <svg x-show="$store.theme.darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg x-show="!$store.theme.darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>

                    <a href="{{ route('donation') }}" wire:navigate class="ml-4 px-6 py-2.5 bg-kamina-gold hover:bg-yellow-600 text-white rounded-xl text-sm font-bold shadow-lg transition-all duration-300 hover:-translate-y-0.5">
                        Faire un Don
                    </a>
                </div>

                <!-- MOBILE BURGER -->
                <div class="flex items-center gap-3 lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2.5 rounded-xl transition-all" 
                            :class="scrolled || !$store.theme.darkMode ? 'bg-slate-100 text-slate-900 dark:bg-gray-800 dark:text-white' : 'bg-white/20 text-white'">
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU (Slide Down) -->
        <div x-show="mobileMenuOpen" x-collapse x-cloak class="lg:hidden bg-white dark:bg-gray-900 border-t border-slate-100 dark:border-gray-800 shadow-2xl absolute w-full left-0 z-50">
            <div class="px-4 py-6 space-y-2 text-center">
                @auth
                    <div class="py-4 border-b border-slate-50 dark:border-gray-800 mb-4">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Session Active</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ auth()->user()->name }}</p>
                    </div>
                @endauth

                @foreach([
                    'home' => 'Accueil',
                    'news.index' => 'Actualités',
                    'parishes.public.index' => 'Paroisses',
                    'liturgie' => 'Liturgie',
                    'contact' => 'Contact'
                ] as $route => $label)
                    <a href="{{ Route::has($route) ? route($route) : '#' }}" wire:navigate @click="mobileMenuOpen = false"
                       class="block px-5 py-4 rounded-2xl text-base font-bold text-slate-700 dark:text-gray-200 hover:bg-slate-50 dark:hover:bg-gray-800">
                        {{ $label }}
                    </a>
                @endforeach
                
                <div class="pt-6 mt-4 border-t border-slate-100 dark:border-gray-800 space-y-3">
                    <a href="{{ route('donation') }}" wire:navigate class="block w-full py-4 rounded-2xl text-lg font-bold text-white bg-kamina-gold shadow-lg shadow-kamina-gold/20">
                        Faire un Don
                    </a>
                    
                    @auth
                        <!-- Bouton de déconnexion visible uniquement quand on est connecté -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-4 rounded-2xl text-sm font-black text-red-500 bg-red-50 dark:bg-red-900/10 uppercase tracking-widest">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-4 rounded-2xl text-sm font-black text-kamina-blue bg-blue-50 dark:bg-blue-900/10 uppercase tracking-widest">
                            Connexion Espace Membre
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>