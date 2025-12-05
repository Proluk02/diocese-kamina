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

    // On passe les variables à la vue
    public function with(): array
    {
        return [
            'notifications' => Auth::user()?->notifications()->take(5)->get() ?? collect([]),
            'unreadNotificationsCount' => Auth::user()?->unreadNotifications()->count() ?? 0,
        ];
    }
}; ?>

<header class="sticky top-0 z-50 flex w-full bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg shadow-sm border-b border-gray-200/60 dark:border-gray-700/60 transition-colors duration-300">
    <div class="flex flex-grow items-center justify-between py-3 px-4 md:px-6">
        
        <!-- GAUCHE -->
        <div class="flex items-center gap-4">
            <!-- Bouton Hamburger -->
            <button @click.stop="window.innerWidth < 1024 ? sidebarOpen = !sidebarOpen : sidebarExpanded = !sidebarExpanded" 
                    class="p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 transition-all duration-200 hover:scale-105 active:scale-95">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <!-- Recherche -->
            <div class="hidden sm:block relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" placeholder="Rechercher..." 
                       class="pl-11 pr-4 py-2.5 rounded-full bg-gray-100/80 dark:bg-gray-800/80 border border-transparent focus:border-kamina-gold/50 focus:bg-white dark:focus:bg-gray-800 focus:ring-2 focus:ring-kamina-gold/20 focus:outline-none text-sm w-72 text-gray-800 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300">
            </div>
        </div>

        <!-- DROITE -->
        <div class="flex items-center gap-2">
            
            <!-- TOGGLE DARK MODE -->
            <button @click="$store.theme.toggle()" 
                    class="p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-yellow-400 transition-all duration-200 hover:scale-105 active:scale-95">
                <svg x-show="$store.theme.darkMode" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg x-show="!$store.theme.darkMode" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            <!-- NOTIFICATIONS -->
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" 
                        @keydown.escape="dropdownOpen = false"
                        class="relative p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-300 transition-all duration-200 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-kamina-gold/20"
                        aria-label="Notifications"
                        :aria-expanded="dropdownOpen">
                    
                    @if($unreadNotificationsCount > 0)
                        <span class="absolute top-1.5 right-1.5 h-3 w-3 rounded-full bg-red-500 border-2 border-white dark:border-gray-900 shadow-sm animate-pulse"></span>
                    @endif
                    
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
                
                <!-- Menu déroulant Notifications -->
                <div x-show="dropdownOpen" x-cloak 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                     @click.outside="dropdownOpen = false"
                     class="absolute right-0 mt-2.5 w-96 bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200/60 dark:border-gray-700/60 backdrop-blur-sm z-50 overflow-hidden">
                     
                     <div class="flex justify-between items-center px-5 py-4 border-b border-gray-100 dark:border-gray-800 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800/50 dark:to-gray-900">
                        <div>
                            <h5 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Notifications</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $unreadNotificationsCount }} non lue(s)</p>
                        </div>
                        @if($unreadNotificationsCount > 0)
                            <button wire:click="markAllAsRead" 
                                    class="text-xs px-3 py-1.5 rounded-lg bg-kamina-blue/10 dark:bg-kamina-gold/10 text-kamina-blue dark:text-kamina-gold hover:bg-kamina-blue/20 dark:hover:bg-kamina-gold/20 transition-colors duration-200 font-medium">
                                Tout marquer comme lu
                            </button>
                        @endif
                     </div>
                     
                     <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
                        @forelse ($notifications as $notification)
                            @php
                                $iconType = $notification->data['icon'] ?? 'default';
                                $iconClasses = [
                                    'user-plus' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800',
                                    'document-text' => 'bg-green-500/10 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800',
                                    'warning' => 'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800',
                                    'default' => 'bg-gray-500/10 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-800'
                                ];
                                $bgClasses = is_null($notification->read_at) 
                                    ? 'bg-gradient-to-r from-blue-50/40 to-transparent dark:from-blue-900/10' 
                                    : '';
                            @endphp
                            <a href="{{ $notification->data['url'] ?? '#' }}" 
                               class="flex gap-4 px-5 py-4 hover:bg-gray-50/80 dark:hover:bg-gray-800/50 transition-all duration-200 {{ $bgClasses }} border-b border-gray-100/50 dark:border-gray-800/50 last:border-b-0 group">
                                
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="h-11 w-11 rounded-xl flex items-center justify-center transition-transform duration-200 group-hover:scale-110 {{ $iconClasses[$iconType] }}">
                                        @if($iconType === 'user-plus')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                            </svg>
                                        @elseif($iconType === 'document-text')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200 leading-snug group-hover:text-kamina-blue dark:group-hover:text-kamina-gold transition-colors">
                                        {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                        @if(is_null($notification->read_at))
                                            <span class="inline-block h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="px-5 py-12 text-center">
                                <div class="h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Aucune notification pour le moment.</p>
                            </div>
                        @endforelse
                     </div>
                     
                     @if($notifications->isNotEmpty())
                        <div class="px-5 py-3 border-t border-gray-100 dark:border-gray-800 bg-gradient-to-r from-gray-50/80 to-white/80 dark:from-gray-800/30 dark:to-gray-900/30">
                            <a href="#" class="block text-center text-sm font-medium text-kamina-blue dark:text-kamina-gold hover:text-kamina-blue/80 dark:hover:text-kamina-gold/80 transition-colors duration-200 py-2 rounded-lg hover:bg-kamina-blue/5 dark:hover:bg-kamina-gold/5">
                                Voir toutes les notifications
                                <svg class="w-4 h-4 inline-block ml-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                     @endif
                </div>
            </div>

            <!-- User Menu -->
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen"
                        @keydown.escape="dropdownOpen = false"
                        class="flex items-center gap-3 focus:outline-none group"
                        aria-label="Menu utilisateur"
                        :aria-expanded="dropdownOpen">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-kamina-gold to-amber-500 text-white flex items-center justify-center font-bold shadow-lg group-hover:shadow-xl transition-all duration-200 group-hover:scale-105">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-transform duration-200" 
                         :class="{ 'rotate-180': dropdownOpen }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="dropdownOpen" x-cloak
                     @click.outside="dropdownOpen = false"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                     class="absolute right-0 mt-2.5 w-64 bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200/60 dark:border-gray-700/60 backdrop-blur-sm z-50 overflow-hidden">
                    
                    <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800/50 dark:to-gray-900">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">{{ auth()->user()->email }}</p>
                    </div>
                    
                    <div class="py-2">
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200 group">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-kamina-blue dark:group-hover:text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="group-hover:text-kamina-blue dark:group-hover:text-kamina-gold transition-colors">Mon Profil</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200 group">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-kamina-blue dark:group-hover:text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="group-hover:text-kamina-blue dark:group-hover:text-kamina-gold transition-colors">Paramètres</span>
                        </a>
                    </div>
                    
                    <div class="border-t border-gray-100 dark:border-gray-800 py-2">
                        <button wire:click="logout" 
                                class="flex items-center gap-3 w-full px-5 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200 group">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="font-medium">Déconnexion</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>