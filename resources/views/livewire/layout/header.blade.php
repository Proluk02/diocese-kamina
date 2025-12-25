<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public bool $isSearching = false;
    public string $searchQuery = '';
    
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
    
    public function toggleSearch(): void
    {
        $this->isSearching = !$this->isSearching;
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function with(): array
    {
        return [
            'notifications' => Auth::user()?->notifications()->take(5)->get() ?? collect([]),
            'unreadNotificationsCount' => Auth::user()?->unreadNotifications()->count() ?? 0,
        ];
    }
}; ?>

<!-- HEADER PRINCIPAL -->
<header class="sticky top-0 z-30 flex w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl shadow-sm border-b border-gray-200/50 dark:border-gray-800/50 transition-all duration-300">
    <div class="flex flex-grow items-center justify-between py-3 px-4 md:px-6">
        
        <!-- ================= GAUCHE : Hamburger & Recherche ================= -->
        <div class="flex items-center gap-4">
            <!-- Bouton Hamburger (Sidebar) -->
            <button @click.stop="window.innerWidth < 1024 ? sidebarOpen = !sidebarOpen : sidebarExpanded = !sidebarExpanded" 
                    class="p-2.5 rounded-xl text-gray-500 hover:text-kamina-blue dark:text-gray-400 dark:hover:text-white hover:bg-gray-100/80 dark:hover:bg-gray-800 transition-all duration-200 active:scale-95">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <!-- Barre de Recherche -->
            <div class="hidden sm:block relative group">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-kamina-gold transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" placeholder="Rechercher..." 
                       class="pl-11 pr-4 py-2.5 rounded-full bg-gray-100/50 dark:bg-gray-800/50 border border-gray-200/50 dark:border-gray-700/50 focus:bg-white dark:focus:bg-gray-900 focus:ring-2 focus:ring-kamina-gold/20 focus:border-kamina-gold/50 outline-none text-sm w-64 focus:w-80 text-gray-700 dark:text-gray-200 placeholder-gray-500 transition-all duration-300 shadow-inner">
            </div>
        </div>

        <!-- ================= DROITE : DarkMode, Notifications, Profil ================= -->
        <div class="flex items-center gap-3">
            
            <!-- TOGGLE DARK MODE -->
            <button @click="$store.theme.toggle()" 
                    class="p-2.5 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-yellow-400 hover:text-orange-500 transition-all duration-300 active:rotate-12">
                <svg x-show="$store.theme.darkMode" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <svg x-show="!$store.theme.darkMode" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
            </button>

            <!-- NOTIFICATIONS -->
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" 
                        class="relative p-2.5 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-all duration-200 active:scale-95">
                    
                    @if($unreadNotificationsCount > 0)
                        <span class="absolute top-2 right-2 h-2.5 w-2.5 rounded-full bg-red-500 border-2 border-white dark:border-gray-900 shadow-sm animate-pulse"></span>
                    @endif
                    
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
                
                <!-- Dropdown Notifications -->
                <div x-show="dropdownOpen" x-cloak 
                     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                     class="absolute right-0 mt-3 w-80 sm:w-96 rounded-2xl bg-white dark:bg-gray-900 shadow-2xl border border-gray-100 dark:border-gray-800 z-50 overflow-hidden ring-1 ring-black/5">
                     
                     <div class="flex justify-between items-center px-5 py-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 backdrop-blur-sm">
                        <div>
                            <h5 class="text-sm font-bold text-gray-800 dark:text-gray-100">Notifications</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $unreadNotificationsCount }} non lue(s)</p>
                        </div>
                        @if($unreadNotificationsCount > 0)
                            <button wire:click="markAllAsRead" class="text-xs px-2 py-1 rounded bg-kamina-blue/10 text-kamina-blue dark:bg-kamina-gold/10 dark:text-kamina-gold font-bold hover:bg-kamina-blue/20 transition-colors uppercase tracking-tight">
                                Tout lire
                            </button>
                        @endif
                     </div>
                     
                     <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
                        @forelse ($notifications as $notification)
                            @php
                                $icon = $notification->data['icon'] ?? 'default';
                                $bgClass = is_null($notification->read_at) ? 'bg-blue-50/60 dark:bg-blue-900/10' : 'hover:bg-gray-50 dark:hover:bg-gray-800/50';
                            @endphp
                            <a href="{{ $notification->data['url'] ?? '#' }}" class="flex gap-4 px-5 py-4 border-b border-gray-100 dark:border-gray-800 transition-colors {{ $bgClass }}">
                                <div class="h-10 w-10 flex-shrink-0 rounded-full flex items-center justify-center 
                                    {{ $icon === 'user-plus' ? 'bg-blue-100 text-blue-600 dark:bg-blue-900/30' : '' }}
                                    {{ $icon === 'document-text' ? 'bg-green-100 text-green-600 dark:bg-green-900/30' : '' }}
                                    {{ $icon === 'default' ? 'bg-gray-100 text-gray-600 dark:bg-gray-800' : '' }}">
                                    
                                    @if($icon === 'user-plus') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" stroke-width="2"/></svg>
                                    @elseif($icon === 'document-text') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/></svg>
                                    @else <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $notification->data['message'] ?? 'Notification' }}</p>
                                    <p class="text-[10px] text-gray-500 mt-1 uppercase font-bold">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                @if(is_null($notification->read_at))
                                    <span class="h-2 w-2 rounded-full bg-kamina-blue dark:bg-kamina-gold mt-2"></span>
                                @endif
                            </a>
                        @empty
                             <div class="px-5 py-10 text-center flex flex-col items-center">
                                <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-full mb-3 text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-width="2"/></svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tout est calme ici.</p>
                             </div>
                        @endforelse
                     </div>
                </div>
            </div>

            <!-- MENU UTILISATEUR & AVATAR DYNAMIQUE -->
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" 
                        class="flex items-center gap-3 pl-2 pr-1 py-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 focus:outline-none group">
                    
                    <!-- Avatar Logic -->
                    <div class="h-9 w-9 rounded-full overflow-hidden border-2 border-white dark:border-gray-800 shadow-md flex items-center justify-center bg-gray-200 dark:bg-gray-700 group-hover:scale-105 transition-transform">
                        @if(auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="h-full w-full object-cover">
                        @elseif(auth()->user()->avatar && str_starts_with(auth()->user()->avatar, 'http'))
                            <img src="{{ auth()->user()->avatar }}" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-kamina-gold to-yellow-600 text-white flex items-center justify-center font-bold uppercase text-xs">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Profil -->
                <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-cloak
                     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                     class="absolute right-0 mt-3 w-64 rounded-2xl bg-white dark:bg-gray-900 shadow-2xl border border-gray-100 dark:border-gray-800 z-50 overflow-hidden ring-1 ring-black/5">
                    
                    <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                        <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate uppercase tracking-widest font-black">{{ auth()->user()->role }}</p>
                    </div>
                    
                    <div class="py-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-5 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-kamina-blue dark:hover:text-kamina-gold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Mon Profil
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-5 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-kamina-blue dark:hover:text-kamina-gold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Paramètres
                        </a>
                    </div>
                    
                    <div class="border-t border-gray-100 dark:border-gray-800 py-2">
                        <button wire:click="logout" class="flex items-center gap-3 w-full text-left px-5 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors font-bold uppercase tracking-tighter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Déconnexion
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>