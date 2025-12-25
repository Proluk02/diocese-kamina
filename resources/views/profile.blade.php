<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8" x-data="{ activeTab: 'profile' }">
        
        <!-- En-tête avec informations utilisateur -->
        <div class="bg-gradient-to-r from-kamina-blue to-blue-700 dark:from-gray-900 dark:to-gray-800 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            <div class="flex flex-col sm:flex-row items-center gap-6 relative z-10">
                <div class="relative">
                    <div class="h-24 w-24 rounded-full border-4 border-white/20 overflow-hidden bg-white/10 backdrop-blur-md shadow-inner">
                        @if(auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="h-full w-full object-cover">
                        @elseif(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-3xl font-black uppercase">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    @if(auth()->user()->is_active)
                        <div class="absolute bottom-1 right-1 h-5 w-5 bg-green-500 rounded-full border-4 border-kamina-blue dark:border-gray-900"></div>
                    @endif
                </div>
                
                <div class="text-center sm:text-left">
                    <h1 class="text-2xl font-bold font-playfair tracking-tight">{{ auth()->user()->name }}</h1>
                    <p class="text-blue-100/80 text-sm font-medium">{{ auth()->user()->email }}</p>
                    
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mt-4">
                        <span class="px-3 py-1 bg-white/10 border border-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest backdrop-blur-sm">
                            {{ auth()->user()->role }}
                        </span>
                        @if(auth()->user()->parish)
                            <span class="px-3 py-1 bg-white/10 border border-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest backdrop-blur-sm">
                                {{ auth()->user()->parish->name }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Décoration -->
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Navigation par onglets -->
        <div class="border-b border-slate-200 dark:border-gray-800">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button @click="activeTab = 'profile'"
                        :class="activeTab === 'profile' ? 'border-kamina-blue text-kamina-blue' : 'border-transparent text-slate-400 hover:text-slate-600'"
                        class="py-4 px-1 border-b-2 font-bold text-xs uppercase tracking-widest transition-all">
                    Informations
                </button>
                <button @click="activeTab = 'security'"
                        :class="activeTab === 'security' ? 'border-kamina-blue text-kamina-blue' : 'border-transparent text-slate-400 hover:text-slate-600'"
                        class="py-4 px-1 border-b-2 font-bold text-xs uppercase tracking-widest transition-all">
                    Sécurité
                </button>
                <button @click="activeTab = 'danger'"
                        :class="activeTab === 'danger' ? 'border-red-500 text-red-600' : 'border-transparent text-slate-400 hover:text-slate-600'"
                        class="py-4 px-1 border-b-2 font-bold text-xs uppercase tracking-widest transition-all">
                    Danger
                </button>
            </nav>
        </div>

        <!-- Contenu des onglets -->
        <div class="mt-4">
            <!-- Onglet Profil -->
            <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2">
                <div class="bg-white dark:bg-gray-900 rounded-3xl border border-slate-100 dark:border-gray-800 shadow-sm p-6 sm:p-8">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <!-- Onglet Sécurité -->
            <div x-show="activeTab === 'security'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-cloak>
                <div class="bg-white dark:bg-gray-900 rounded-3xl border border-slate-100 dark:border-gray-800 shadow-sm p-6 sm:p-8">
                    <div class="max-w-xl">
                        <livewire:profile.update-password-form />
                    </div>
                </div>
            </div>

            <!-- Onglet Danger -->
            <div x-show="activeTab === 'danger'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-cloak>
                <div class="bg-red-50/50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20 rounded-3xl p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-red-800 dark:text-red-400 uppercase tracking-tighter">Suppression définitive</h3>
                    <p class="text-sm text-slate-500 dark:text-gray-400 mt-2 mb-8">
                        Cette action effacera toutes vos données de nos serveurs.
                    </p>
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="pt-8 text-center border-t border-slate-100 dark:border-gray-800">
            <p class="text-[10px] text-slate-400 uppercase tracking-[0.4em] font-bold">
                {{ config('app.name') }} &bull; Depuis {{ auth()->user()->created_at->format('Y') }}
            </p>
        </div>
    </div>
</x-app-layout>