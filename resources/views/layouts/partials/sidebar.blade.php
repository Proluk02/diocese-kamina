<div class="flex h-full flex-col justify-between text-white">
    <!-- HEADER SIDEBAR -->
    <div class="flex items-center justify-between px-4 py-5 border-b border-gray-800/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="relative flex-shrink-0">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-kamina-gold to-yellow-600 flex items-center justify-center text-brand-dark font-bold shadow-lg">DK</div>
            </div>
            <div class="flex flex-col overflow-hidden transition-all duration-300" x-show="sidebarExpanded">
                <span class="text-white text-lg font-bold tracking-wider whitespace-nowrap">KAMINA</span>
                <span class="text-xs text-gray-400 whitespace-nowrap">Administration</span>
            </div>
        </a>
        <button @click="sidebarExpanded = !sidebarExpanded" class="hidden lg:block text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" :class="{ 'rotate-180': !sidebarExpanded }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" /></svg>
        </button>
    </div>

    <!-- MENU -->
    <nav class="mt-5 px-3 space-y-1 overflow-y-auto no-scrollbar">
        
        <!-- DASHBOARD (Commun) -->
        <a href="{{ route('dashboard') }}" wire:navigate
           class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" /></svg>
            <span x-show="sidebarExpanded">Tableau de bord</span>
        </a>

        <!-- MENU MUSICIEN (Exclusif) -->
        @if(auth()->user()->role === 'musician')
            <div class="mt-4 pt-4 border-t border-gray-800">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2" x-show="sidebarExpanded">Mon Espace</h3>
                <a href="{{ route('admin.songs.index') }}" wire:navigate class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium {{ request()->routeIs('admin.songs.*') ? 'bg-kamina-gold text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                    <span x-show="sidebarExpanded">Mes Chants</span>
                </a>
            </div>
        @else
            <!-- MENU GÉNÉRAL (Admin, Clergé) -->
            
            <!-- Publications -->
            <div x-data="{ open: {{ request()->routeIs('admin.articles.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.documents.*') ? 'true' : 'false' }} }">
                <button @click="if(sidebarExpanded) open = !open" class="w-full group flex items-center justify-between rounded-xl px-3 py-2.5 font-medium transition-all text-gray-400 hover:bg-white/5 hover:text-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                        <span x-show="sidebarExpanded">Publications</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" x-show="sidebarExpanded" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open && sidebarExpanded" x-collapse class="space-y-1 pl-10 mt-1">
                    <a href="{{ route('admin.articles.index') }}" wire:navigate class="block py-2 text-sm text-gray-400 hover:text-white">Articles</a>
                    <a href="{{ route('admin.categories.index') }}" wire:navigate class="block py-2 text-sm text-gray-400 hover:text-white">Catégories</a>
                    <a href="{{ route('admin.documents.index') }}" wire:navigate class="block py-2 text-sm text-gray-400 hover:text-white">Documents</a>
                </div>
            </div>

            <!-- Structures -->
            <a href="{{ route('admin.parishes.index') }}" wire:navigate class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium text-gray-400 hover:bg-white/5 hover:text-white">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                <span x-show="sidebarExpanded">Paroisses</span>
            </a>

            <!-- Liturgie (Admin View) -->
            <a href="{{ route('admin.songs.index') }}" wire:navigate class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium text-gray-400 hover:bg-white/5 hover:text-white">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                <span x-show="sidebarExpanded">Gestion Liturgie</span>
            </a>

            <!-- Administration (Super Admin) -->
            @if(auth()->user()->isAdmin())
            <div class="mt-4 pt-4 border-t border-gray-800">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2" x-show="sidebarExpanded">Administration</h3>
                
                <a href="{{ route('admin.clergy.index') }}" wire:navigate class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium text-gray-400 hover:bg-white/5 hover:text-white">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <span x-show="sidebarExpanded">Clergé</span>
                </a>

                <a href="{{ route('admin.users.index') }}" wire:navigate class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium text-gray-400 hover:bg-white/5 hover:text-white">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span x-show="sidebarExpanded">Utilisateurs</span>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" wire:navigate class="group flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium text-gray-400 hover:bg-white/5 hover:text-white">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <span x-show="sidebarExpanded">Paramètres</span>
                </a>
            </div>
            @endif
        @endif

    </nav>
    
    <!-- Profil en bas -->
    <div class="p-4 border-t border-gray-800" x-show="sidebarExpanded">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 cursor-pointer hover:bg-white/5 p-2 rounded-lg transition">
            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold shadow">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate capitalize">{{ auth()->user()->role }}</p>
            </div>
        </a>
    </div>
</div>