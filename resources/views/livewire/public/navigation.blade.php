<div class="w-full z-50" x-data="{ mobileMenuOpen: false }">
    
    <!-- TOP BAR (Infos rapides) -->
    <div class="bg-kamina-blue text-white py-2 text-xs font-medium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    +243 999 000 000
                </span>
                <span class="hidden sm:flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    contact@diocesekamina.org
                </span>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="hover:text-kamina-gold transition">Facebook</a>
                <a href="#" class="hover:text-kamina-gold transition">YouTube</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="ml-4 bg-white/10 hover:bg-white/20 px-2 py-1 rounded transition">Espace Admin</a>
                @else
                    <a href="{{ route('login') }}" class="ml-4 flex items-center gap-1 hover:text-kamina-gold transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Connexion
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR (Sticky) -->
    <nav class="bg-white shadow-md sticky top-0 w-full z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                
                <!-- LOGO -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="h-10 w-10 bg-kamina-blue text-white rounded-lg flex items-center justify-center font-bold text-xl group-hover:bg-kamina-gold transition-colors">DK</div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-kamina-blue leading-none tracking-wide font-playfair">DIOCÈSE</span>
                            <span class="text-xs text-gray-500 font-medium tracking-[0.2em] uppercase">de Kamina</span>
                        </div>
                    </a>
                </div>

                <!-- DESKTOP MENU (Module A & B) -->
                <div class="hidden md:flex space-x-8 items-center">
                    <!-- Liens Module A -->
                    <a href="/" class="text-sm font-medium text-gray-700 hover:text-kamina-blue border-b-2 border-transparent hover:border-kamina-gold transition py-2">Accueil</a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-kamina-blue border-b-2 border-transparent hover:border-kamina-gold transition py-2">Actualités</a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-kamina-blue border-b-2 border-transparent hover:border-kamina-gold transition py-2">Le Diocèse</a>
                    
                    <!-- Liens Module B -->
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-kamina-blue border-b-2 border-transparent hover:border-kamina-gold transition py-2">Paroisses</a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-kamina-blue border-b-2 border-transparent hover:border-kamina-gold transition py-2">Liturgie & Chants</a>

                    <a href="#" class="bg-kamina-gold text-white px-5 py-2 rounded-full text-sm font-bold shadow-md hover:bg-yellow-600 transition hover:-translate-y-0.5">
                        Faire un Don
                    </a>
                </div>

                <!-- MOBILE BURGER -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-kamina-blue p-2 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU (Slide down) -->
        <div x-show="mobileMenuOpen" x-collapse class="md:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="/" class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-kamina-blue hover:bg-gray-50">Accueil</a>
                <a href="#" class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-kamina-blue hover:bg-gray-50">Actualités</a>
                <a href="#" class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-kamina-blue hover:bg-gray-50">Paroisses</a>
                <a href="#" class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-kamina-blue hover:bg-gray-50">Liturgie</a>
                <a href="#" class="block px-3 py-3 rounded-md text-base font-medium text-kamina-gold hover:bg-yellow-50 font-bold">Faire un Don</a>
            </div>
        </div>
    </nav>
</div>