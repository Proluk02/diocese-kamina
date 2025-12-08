<div class="flex h-full flex-col justify-between text-white">
    <div>
        <!-- HEADER SIDEBAR -->
        <div class="flex items-center justify-between px-4 py-5 border-b border-gray-800/50">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <div class="relative flex-shrink-0">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-kamina-gold to-yellow-600 flex items-center justify-center text-brand-dark font-bold shadow-lg">
                        DK
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden transition-all duration-300" x-show="sidebarExpanded">
                    <span class="text-white text-lg font-bold tracking-wider whitespace-nowrap">KAMINA</span>
                    <span class="text-xs text-gray-400 whitespace-nowrap">Diocèse</span>
                </div>
            </a>
            
            <!-- Toggle Desktop -->
            <button @click="sidebarExpanded = !sidebarExpanded" class="hidden lg:block text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" :class="{ 'rotate-180': !sidebarExpanded }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" /></svg>
            </button>
        </div>

        <!-- MENU -->
        <nav class="mt-5 px-3 space-y-1 overflow-y-auto no-scrollbar">
            
            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2" x-show="sidebarExpanded">
                Menu Principal
            </h3>

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" wire:navigate
               class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white shadow-lg' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" /></svg>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Tableau de bord</span>
            </a>

            <!-- Publications (Dropdown) -->
            <div x-data="{ open: {{ request()->routeIs('admin.articles.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.documents.*') ? 'true' : 'false' }} }">
                <button @click="if(sidebarExpanded) open = !open" 
                        class="w-full group flex items-center justify-between rounded-xl px-3 py-2.5 font-medium transition-all text-gray-400 hover:bg-white/5 hover:text-white"
                        :class="open ? 'text-white' : ''">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                        <span x-show="sidebarExpanded" class="whitespace-nowrap">Publications</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" x-show="sidebarExpanded" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                
                <div x-show="open && sidebarExpanded" x-collapse class="space-y-1 pl-10 mt-1">
                    <a href="{{ route('admin.articles.index') }}" wire:navigate 
                       class="block py-2 text-sm transition {{ request()->routeIs('admin.articles.*') ? 'text-kamina-gold font-medium' : 'text-gray-400 hover:text-white' }}">
                       Tous les articles
                    </a>
                    <a href="{{ route('admin.categories.index') }}" wire:navigate 
                       class="block py-2 text-sm transition {{ request()->routeIs('admin.categories.*') ? 'text-kamina-gold font-medium' : 'text-gray-400 hover:text-white' }}">
                       Catégories
                    </a>
                    <a href="{{ route('admin.documents.index') }}" wire:navigate 
                       class="block py-2 text-sm transition {{ request()->routeIs('admin.documents.*') ? 'text-kamina-gold font-medium' : 'text-gray-400 hover:text-white' }}">
                       Documents Officiels
                    </a>
                </div>
            </div>

            <!-- NOUVELLE SECTION : STRUCTURES -->
            <div class="mt-4 pt-4 border-t border-gray-800">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2" x-show="sidebarExpanded">
                    Structures
                </h3>
                <a href="{{ route('admin.parishes.index') }}" wire:navigate
                   class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium transition-all duration-200 {{ request()->routeIs('admin.parishes.*') ? 'bg-white/10 text-white shadow-lg' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <!-- Icone Eglise -->
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span x-show="sidebarExpanded" class="whitespace-nowrap">Paroisses</span>
                </a>
            </div>

            <!-- Admin -->
            @if(auth()->user()->isAdmin())
            <div class="mt-4 pt-4 border-t border-gray-800">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2" x-show="sidebarExpanded">
                    Administration
                </h3>
                <a href="{{ route('admin.users.index') }}" wire:navigate
                   class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white shadow-lg' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <span x-show="sidebarExpanded" class="whitespace-nowrap">Utilisateurs</span>
                </a>
            </div>
            @endif

        </nav>
    </div>

    <!-- PROFIL -->
    <div class="p-4 border-t border-gray-800" x-show="sidebarExpanded">
        <div class="flex items-center gap-3 cursor-pointer hover:bg-white/5 p-2 rounded-lg transition">
            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold shadow">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate capitalize">{{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>
</div>