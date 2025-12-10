<div class="w-full z-50 font-sans" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    
    <!-- TOP BAR (Infos & Social) -->
    <div class="bg-kamina-blue text-white py-2 text-xs border-b border-blue-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                <a href="tel:+243000000000" class="flex items-center gap-1.5 hover:text-kamina-gold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <span>Secrétariat</span>
                </a>
                <a href="mailto:contact@diocesekamina.org" class="hidden sm:flex items-center gap-1.5 hover:text-kamina-gold transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>contact@diocesekamina.org</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-1 bg-white/10 hover:bg-white/20 px-3 py-1 rounded-full transition">
                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                        Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-kamina-gold transition font-medium">Espace Membres</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR (Sticky) -->
    <nav class="bg-white shadow-sm sticky top-0 w-full z-40" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 transition-all duration-300" :class="scrolled ? 'h-16' : 'h-20'">
                
                <!-- LOGO -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="relative">
                            <div class="h-10 w-10 bg-kamina-blue text-white rounded-lg flex items-center justify-center font-bold text-xl group-hover:bg-kamina-gold transition-colors duration-300 shadow-md">DK</div>
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
                        <div x-show="open" x-transition.opacity.duration.200ms
                             class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                            <a href="{{ route('presentation') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-kamina-blue">
                                Présentation & Évêque
                            </a>
                            <a href="{{ route('documents.public.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-kamina-blue">
                                Médiathèque & Documents
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ route('contact') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-kamina-blue">
                                Nous Contacter
                            </a>
                        </div>
                    </div>

                    <!-- Module B (Liens Placeholder) -->
                    <a href="{{ route('parishes.public.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-kamina-blue hover:bg-gray-50 rounded-full transition-colors">
                       Paroisses
                    </a>
                    
                    <a href="{{ route('liturgy.public.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-kamina-blue hover:bg-gray-50 rounded-full transition-colors">
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

                <!-- MOBILE BURGER -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-kamina-blue p-2 focus:outline-none">
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU (Slide down) -->
        <div x-show="mobileMenuOpen" x-collapse class="md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full z-50">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-kamina-blue' : 'text-gray-700 hover:bg-gray-50' }}">
                    Accueil
                </a>
                <a href="{{ route('news.index') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('news.*') ? 'bg-blue-50 text-kamina-blue' : 'text-gray-700 hover:bg-gray-50' }}">
                    Actualités
                </a>
                
                <div class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Le Diocèse</div>
                <a href="{{ route('presentation') }}" class="block px-4 py-2 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50 ml-2 border-l-2 border-gray-100 hover:border-kamina-blue">
                    Présentation
                </a>
                <a href="{{ route('documents.public.index') }}" class="block px-4 py-2 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50 ml-2 border-l-2 border-gray-100 hover:border-kamina-blue">
                    Documents
                </a>
                <a href="{{ route('contact') }}" class="block px-4 py-2 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50 ml-2 border-l-2 border-gray-100 hover:border-kamina-blue">
                    Contact
                </a>

                <div class="border-t border-gray-100 my-2"></div>
                
                <a href="{{ route('parishes.public.index') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50">
                    Paroisses
                </a>
                <a href="{{ route('liturgy.public.index') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50">
                    Liturgie
                </a>
                <a href="{{ route('donation') }}" class="block px-4 py-3 rounded-lg text-base font-bold text-kamina-gold bg-yellow-50 text-center mt-4">
                    Faire un Don
                </a>
            </div>
        </div>
    </nav>
</div>