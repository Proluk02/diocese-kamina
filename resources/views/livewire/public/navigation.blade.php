<div class="w-full z-50 font-sans" x-data="{ mobileMenuOpen: false }">
    
    <!-- TOP BAR (Infos & Social) -->
    <div class="bg-kamina-blue text-white py-2 text-xs border-b border-blue-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            
            <!-- Gauche: Contact -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                <a href="tel:+243999000000" class="flex items-center gap-1.5 hover:text-kamina-gold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <span>Secrétariat</span>
                </a>
                <a href="mailto:contact@diocesekamina.org" class="hidden sm:flex items-center gap-1.5 hover:text-kamina-gold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>contact@diocesekamina.org</span>
                </a>
            </div>

            <!-- Droite: Connexion / Admin -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 px-3 py-1 rounded-full transition">
                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                        <span class="font-medium">Admin</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-kamina-gold transition font-medium flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Espace Membres
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR (Sticky & Scrolled State) -->
    <nav class="bg-white shadow-sm sticky top-0 w-full z-40 transition-all duration-300"
         x-data="{ scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="scrolled ? 'shadow-md bg-white/95 backdrop-blur-md' : 'shadow-sm'">
         
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-300" :class="scrolled ? 'h-16' : 'h-20'">
                
                <!-- LOGO -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="relative">
                            <div class="h-10 w-10 bg-kamina-blue text-white rounded-lg flex items-center justify-center font-bold text-xl group-hover:bg-kamina-gold transition-colors duration-300 shadow-md">
                                DK
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-gray-900 leading-none tracking-wide font-playfair group-hover:text-kamina-blue transition">DIOCÈSE</span>
                            <span class="text-[10px] text-gray-500 font-bold tracking-[0.25em] uppercase">de Kamina</span>
                        </div>
                    </a>
                </div>

                <!-- DESKTOP MENU -->
                <div class="hidden md:flex space-x-1 items-center">
                    
                    <a href="{{ route('home') }}" 
                       class="px-4 py-2 text-sm font-semibold rounded-full transition-colors {{ request()->routeIs('home') ? 'text-kamina-blue bg-blue-50' : 'text-gray-600 hover:text-kamina-blue hover:bg-gray-50' }}">
                       Accueil
                    </a>

                    <a href="{{ route('news.index') }}" 
                       class="px-4 py-2 text-sm font-semibold rounded-full transition-colors {{ request()->routeIs('news.*') ? 'text-kamina-blue bg-blue-50' : 'text-gray-600 hover:text-kamina-blue hover:bg-gray-50' }}">
                       Actualités
                    </a>

                    <!-- Dropdown "Le Diocèse" (Module A) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1 px-4 py-2 text-sm font-semibold rounded-full transition-colors {{ request()->routeIs('presentation') || request()->routeIs('documents.*') || request()->routeIs('contact') ? 'text-kamina-blue bg-blue-50' : 'text-gray-600 hover:text-kamina-blue hover:bg-gray-50' }}">
                            Le Diocèse
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Dropdown Content -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                            <a href="{{ route('presentation') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-kamina-blue transition">
                                Présentation & Évêque
                            </a>
                            <a href="{{ route('documents.public.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-kamina-blue transition">
                                Médiathèque & Documents
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ route('contact') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-kamina-blue transition">
                                Nous Contacter
                            </a>
                        </div>
                    </div>

                    <!-- Module B (Liens Placeholder) -->
                    <a href="{{ route('parishes.public.index') }}" class="px-4 py-2 text-sm font-semibold rounded-full transition-colors {{ request()->routeIs('parishes.*') ? 'text-kamina-blue bg-blue-50' : 'text-gray-600 hover:text-kamina-blue hover:bg-gray-50' }}">
                       Paroisses
                    </a>
                    
                    <a href="{{ route('liturgy.public.index') }}" class="px-4 py-2 text-sm font-semibold rounded-full transition-colors {{ request()->routeIs('liturgy.*') ? 'text-kamina-blue bg-blue-50' : 'text-gray-600 hover:text-kamina-blue hover:bg-gray-50' }}">
                       Liturgie
                    </a>

                    <!-- CTA Don -->
                    <div class="ml-4 pl-4 border-l border-gray-200">
                        <a href="{{ route('donation') }}" class="flex items-center gap-2 bg-kamina-gold hover:bg-yellow-600 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            Faire un Don
                        </a>
                    </div>
                </div>

                <!-- MOBILE BURGER BUTTON -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-kamina-blue p-2 focus:outline-none transition">
                        <svg class="h-7 w-7" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="h-7 w-7" x-show="mobileMenuOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU (Slide down) -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-white border-t border-gray-100 shadow-xl absolute w-full z-50 max-h-[90vh] overflow-y-auto">
            
            <div class="px-4 pt-4 pb-8 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-kamina-blue' : 'text-gray-700 hover:bg-gray-50' }}">
                    Accueil
                </a>
                <a href="{{ route('news.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('news.*') ? 'bg-blue-50 text-kamina-blue' : 'text-gray-700 hover:bg-gray-50' }}">
                    Actualités
                </a>
                
                <div class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider mt-4">Le Diocèse</div>
                <a href="{{ route('presentation') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 hover:bg-gray-50 ml-2 border-l-2 border-transparent hover:border-kamina-blue transition">
                    Présentation
                </a>
                <a href="{{ route('documents.public.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 hover:bg-gray-50 ml-2 border-l-2 border-transparent hover:border-kamina-blue transition">
                    Documents & Homélies
                </a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 hover:bg-gray-50 ml-2 border-l-2 border-transparent hover:border-kamina-blue transition">
                    Contact
                </a>

                <div class="border-t border-gray-100 my-4"></div>
                
                <a href="{{ route('parishes.public.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 hover:bg-gray-50">
                    Paroisses
                </a>
                <a href="{{ route('liturgy.public.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 hover:bg-gray-50">
                    Liturgie & Chants
                </a>
                
                <div class="mt-6 px-4">
                    <a href="{{ route('donation') }}" class="block w-full py-3 rounded-xl text-base font-bold text-white bg-kamina-gold hover:bg-yellow-600 text-center shadow-md transition">
                        Faire un Don
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>