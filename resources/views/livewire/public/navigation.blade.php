<div class="fixed top-0 w-full z-50 transition-all duration-500 ease-in-out" 
     x-data="{ 
        scrolled: false, 
        mobileMenuOpen: false 
     }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white/95 dark:bg-gray-900/95 backdrop-blur-md shadow-md py-0' : 'bg-transparent py-4'">
    
    <!-- TOP BAR (Contact) - Disparaît au scroll -->
    <div class="w-full overflow-hidden transition-all duration-300"
         :class="scrolled ? 'h-0 opacity-0' : 'h-auto opacity-100 border-b border-white/10 pb-2'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-xs font-medium text-white/90">
            <div class="flex gap-4">
                @if(!empty($S['contact_phone']))
                <a href="tel:{{ $S['contact_phone'] }}" class="hover:text-kamina-gold transition flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ $S['contact_phone'] }}
                </a>
                @endif
                
                @if(!empty($S['contact_email']))
                <a href="mailto:{{ $S['contact_email'] }}" class="hidden sm:flex hover:text-kamina-gold transition items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ $S['contact_email'] }}
                </a>
                @endif
            </div>
            <div class="flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-kamina-gold transition">Espace Membres</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- NAVBAR PRINCIPALE -->
    <nav class="w-full mt-2 transition-all duration-300" :class="scrolled ? 'mt-0' : 'mt-2'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- LOGO -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="relative transition-all duration-300" :class="scrolled ? 'scale-90' : 'scale-100'">
                            <!-- Logo Box -->
                            <div class="h-10 w-10 rounded-lg flex items-center justify-center font-bold text-xl shadow-lg transition-colors duration-300"
                                 :class="scrolled ? 'bg-kamina-blue text-white' : 'bg-white text-kamina-blue'">
                                DK
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold font-playfair tracking-wide transition-colors duration-300"
                                  :class="scrolled ? 'text-gray-900 dark:text-white' : 'text-white'">
                                DIOCÈSE
                            </span>
                            <span class="text-[10px] font-bold tracking-[0.25em] uppercase transition-colors duration-300"
                                  :class="scrolled ? 'text-gray-500 dark:text-gray-400' : 'text-white/80'">
                                de {{ $S['site_name'] ?? 'Kamina' }}
                            </span>
                        </div>
                    </a>
                </div>

                <!-- DESKTOP MENU -->
                <div class="hidden md:flex items-center space-x-1">
                    
                    @foreach([
                        ['label' => 'Accueil', 'route' => 'home'],
                        ['label' => 'Actualités', 'route' => 'news.index'],
                        ['label' => 'Paroisses', 'route' => 'parishes.public.index'],
                        ['label' => 'Liturgie', 'route' => 'liturgy.public.index'],
                    ] as $item)
                        <a href="{{ route($item['route']) }}" wire:navigate
                           class="px-4 py-2 text-sm font-semibold rounded-full transition-all duration-300 hover:-translate-y-0.5"
                           :class="[
                               scrolled 
                                ? ({{ request()->routeIs($item['route'].'*') ? 'true' : 'false' }} ? 'text-kamina-blue bg-blue-50 dark:bg-blue-900/30 dark:text-blue-300' : 'text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800')
                                : ({{ request()->routeIs($item['route'].'*') ? 'true' : 'false' }} ? 'text-white bg-white/20' : 'text-white/90 hover:text-white hover:bg-white/10')
                           ]">
                           {{ $item['label'] }}
                        </a>
                    @endforeach

                    <!-- Dropdown "Ressources" -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-4 py-2 text-sm font-semibold rounded-full transition-all duration-300"
                                :class="scrolled ? 'text-gray-600 dark:text-gray-300 hover:text-kamina-blue hover:bg-gray-50' : 'text-white/90 hover:text-white hover:bg-white/10'">
                            Plus
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" x-transition.opacity.duration.200ms 
                             class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 py-2 z-50 origin-top-right">
                            <a href="{{ route('presentation') }}" wire:navigate class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-kamina-blue">Présentation</a>
                            <a href="{{ route('documents.public.index') }}" wire:navigate class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-kamina-blue">Documents Officiels</a>
                            <a href="{{ route('contact') }}" wire:navigate class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-kamina-blue">Contact</a>
                        </div>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <button @click="$store.theme.toggle()" 
                            class="p-2 rounded-full transition-colors ml-2"
                            :class="scrolled ? 'text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' : 'text-white/80 hover:bg-white/10 hover:text-white'">
                        <!-- Soleil -->
                        <svg x-show="!$store.theme.darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <!-- Lune -->
                        <svg x-show="$store.theme.darkMode" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>

                    <!-- CTA Don -->
                    <a href="{{ route('donation') }}" wire:navigate class="ml-3 px-6 py-2.5 bg-kamina-gold hover:bg-yellow-600 text-white rounded-full text-sm font-bold shadow-lg shadow-black/20 hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                        Faire un Don
                    </a>
                </div>

                <!-- MOBILE BURGER -->
                <div class="flex items-center gap-4 md:hidden">
                    <!-- Bouton Dark Mode Mobile -->
                    <button @click="$store.theme.toggle()" :class="scrolled ? 'text-gray-600 dark:text-gray-300' : 'text-white'">
                        <svg x-show="!$store.theme.darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg x-show="$store.theme.darkMode" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>
                    <!-- Bouton Menu -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg focus:outline-none transition" :class="scrolled ? 'text-gray-800 dark:text-white' : 'text-white'">
                        <svg class="h-8 w-8" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="h-8 w-8" x-show="mobileMenuOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU (Full Screen Overlay) -->
        <div x-show="mobileMenuOpen" x-collapse 
             class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 shadow-2xl absolute w-full left-0 z-50 overflow-y-auto max-h-[90vh]">
            <div class="px-4 py-6 space-y-2">
                @foreach([
                    'home' => 'Accueil',
                    'news.index' => 'Actualités',
                    'parishes.public.index' => 'Paroisses',
                    'liturgy.public.index' => 'Liturgie',
                    'documents.public.index' => 'Documents',
                    'presentation' => 'Présentation',
                    'contact' => 'Contact'
                ] as $route => $label)
                    <a href="{{ route($route) }}" wire:navigate
                       class="block px-4 py-3 rounded-xl text-base font-semibold transition {{ request()->routeIs($route) ? 'bg-kamina-blue text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        {{ $label }}
                    </a>
                @endforeach
                
                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800">
                    <a href="{{ route('donation') }}" wire:navigate class="block w-full py-3 rounded-xl text-base font-bold text-white bg-kamina-gold text-center shadow-md">
                        Faire un Don
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>