<div class="fixed top-0 w-full z-50 transition-all duration-500 ease-in-out" 
     x-data="{ 
        scrolled: false, 
        mobileMenuOpen: false 
     }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white/95 dark:bg-gray-900/95 backdrop-blur-md shadow-lg py-0' : 'bg-transparent py-4'">
    
    <!-- TOP BAR (Contact) - Disparaît au scroll -->
    <div class="w-full overflow-hidden transition-all duration-300"
         :class="scrolled ? 'h-0 opacity-0' : 'h-auto opacity-100 border-b border-white/10 pb-2'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-xs font-medium text-white/90">
            <div class="flex gap-4">
                <a href="tel:+243999000000" class="hover:text-kamina-gold transition flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Secrétariat
                </a>
                <a href="mailto:contact@diocesekamina.org" class="hidden sm:flex hover:text-kamina-gold transition items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    contact@diocesekamina.org
                </a>
            </div>
            <div class="flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition text-xs">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-kamina-gold transition text-xs">Espace Membres</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- NAVBAR PRINCIPALE -->
    <nav class="w-full transition-all duration-300" :class="scrolled ? 'mt-0' : 'mt-2'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- LOGO -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="relative transition-all duration-300" :class="scrolled ? 'scale-90' : 'scale-100'">
                            <!-- Logo Box -->
                            <div class="h-10 w-10 rounded-xl flex items-center justify-center font-bold text-xl shadow-lg transition-all duration-300 group-hover:scale-105"
                                 :class="scrolled ? 'bg-gradient-to-br from-kamina-blue to-blue-600 text-white shadow-blue-200 dark:shadow-blue-900/50' : 'bg-white text-kamina-blue shadow-white/20'">
                                DK
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold font-playfair tracking-wide transition-colors duration-300 group-hover:text-kamina-gold"
                                  :class="scrolled ? 'text-gray-900 dark:text-white' : 'text-white'">
                                DIOCÈSE
                            </span>
                            <span class="text-[10px] font-bold tracking-[0.25em] uppercase transition-colors duration-300"
                                  :class="scrolled ? 'text-gray-500 dark:text-gray-400' : 'text-white/80'">
                                de Kamina
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
                        <a href="{{ route($item['route']) }}" 
                           class="px-4 py-2 text-sm font-semibold rounded-full transition-all duration-300 hover:-translate-y-0.5 relative group"
                           :class="[
                               scrolled 
                                ? ({{ request()->routeIs($item['route'].'*') ? 'true' : 'false' }} 
                                    ? 'text-kamina-blue dark:text-blue-300' 
                                    : 'text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white')
                                : ({{ request()->routeIs($item['route'].'*') ? 'true' : 'false' }} 
                                    ? 'text-white bg-white/20' 
                                    : 'text-white/90 hover:text-white')
                           ]">
                           {{ $item['label'] }}
                           <!-- Hover underline effect -->
                           <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-kamina-gold transition-all duration-300 group-hover:w-4"></span>
                        </a>
                    @endforeach

                    <!-- Dropdown "Ressources" -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-4 py-2 text-sm font-semibold rounded-full transition-all duration-300 relative group"
                                :class="scrolled ? 'text-gray-600 dark:text-gray-300 hover:text-kamina-blue' : 'text-white/90 hover:text-white'">
                            Plus
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            <!-- Hover underline effect -->
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-kamina-gold transition-all duration-300 group-hover:w-4"></span>
                        </button>
                        
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-900 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50 overflow-hidden backdrop-blur-lg bg-white/95 dark:bg-gray-900/95">
                            <div class="py-1">
                                <a href="{{ route('presentation') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-kamina-blue dark:hover:text-blue-300 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Présentation
                                </a>
                                <a href="{{ route('documents.public.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-kamina-blue dark:hover:text-blue-300 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Documents Officiels
                                </a>
                                <a href="{{ route('contact') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-kamina-blue dark:hover:text-blue-300 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    Contact
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- BOUTON DARK/LIGHT MODE -->
                    <div class="relative mx-2">
                        <button @click="$store.theme.toggle()" 
                                class="p-2.5 rounded-full transition-all duration-300 hover:scale-110 group relative"
                                :class="scrolled 
                                    ? 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-kamina-blue dark:hover:text-blue-300' 
                                    : 'text-white/90 hover:text-white hover:bg-white/10'">
                            <!-- Soleil (Light) -->
                            <svg x-show="!$store.theme.darkMode" class="w-5 h-5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <!-- Lune (Dark) -->
                            <svg x-show="$store.theme.darkMode" class="w-5 h-5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            <!-- Tooltip -->
                            <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs bg-gray-900 text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                <span x-text="$store.theme.darkMode ? 'Mode clair' : 'Mode sombre'"></span>
                            </span>
                        </button>
                    </div>

                    <!-- CTA Don -->
                    <a href="{{ route('donation') }}" 
                       class="ml-2 px-6 py-2.5 bg-gradient-to-r from-kamina-gold to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-white rounded-full text-sm font-bold shadow-lg shadow-yellow-500/20 dark:shadow-yellow-900/30 hover:shadow-xl transition-all transform hover:-translate-y-0.5 active:scale-95 relative overflow-hidden group">
                       <span class="relative z-10">Faire un Don</span>
                       <span class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-yellow-600 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                    </a>
                </div>

                <!-- MOBILE BURGER -->
                <div class="flex items-center gap-4 md:hidden">
                    <!-- Bouton Dark Mode Mobile -->
                    <button @click="$store.theme.toggle()" 
                            :class="scrolled ? 'text-gray-600 dark:text-gray-300 hover:text-kamina-blue' : 'text-white/90 hover:text-white'"
                            class="p-2 rounded-full transition-colors hover:bg-white/10">
                        <svg x-show="!$store.theme.darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg x-show="$store.theme.darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    <!-- Bouton Menu -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="p-2 rounded-lg focus:outline-none transition hover:bg-white/10"
                            :class="scrolled ? 'text-gray-800 dark:text-white' : 'text-white'">
                        <svg class="h-8 w-8" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="h-8 w-8" x-show="mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU (Full Screen Overlay) -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 shadow-2xl absolute w-full left-0 z-50 overflow-y-auto max-h-[90vh] backdrop-blur-lg bg-white/95 dark:bg-gray-900/95">
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
                    <a href="{{ route($route) }}" 
                       @click="mobileMenuOpen = false"
                       class="block px-4 py-3.5 rounded-xl text-base font-semibold transition-all duration-300 hover:pl-6 active:scale-95 {{ request()->routeIs($route) ? 'bg-gradient-to-r from-kamina-blue to-blue-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-kamina-blue dark:hover:text-blue-300' }}">
                        <div class="flex items-center gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-current opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            {{ $label }}
                        </div>
                    </a>
                @endforeach
                
                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800">
                    <a href="{{ route('donation') }}" 
                       @click="mobileMenuOpen = false"
                       class="block w-full py-3.5 rounded-xl text-base font-bold text-white bg-gradient-to-r from-kamina-gold to-yellow-600 text-center shadow-lg active:scale-95 transition-transform">
                        Faire un Don
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>

<!-- Alpine.js Store pour le thème -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('theme', {
            darkMode: localStorage.getItem('darkMode') === 'true' || 
                     (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
            
            toggle() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
                this.applyTheme();
            },
            
            applyTheme() {
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            },
            
            init() {
                this.applyTheme();
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    if (!('darkMode' in localStorage)) {
                        this.darkMode = e.matches;
                        this.applyTheme();
                    }
                });
            }
        });
        
        Alpine.store('theme').init();
    });
</script>