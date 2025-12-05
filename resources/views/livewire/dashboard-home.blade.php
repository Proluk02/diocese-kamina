<div class="space-y-8 animate-fadeIn">
    
    <!-- 1. EN-TÊTE & BIENVENUE -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">
                Vue d'ensemble
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Bienvenue sur l'espace de gestion du <span class="font-semibold text-kamina-blue dark:text-kamina-gold">Diocèse de Kamina</span>.
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="hidden md:flex flex-col items-end mr-2">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Aujourd'hui</span>
                <span class="text-sm font-bold text-gray-700 dark:text-gray-200">{{ now()->translatedFormat('l d F Y') }}</span>
            </div>
            <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 text-kamina-gold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>
    </div>

    <!-- 2. CARTES STATISTIQUES (GRID AMÉLIORÉE) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Carte 1 : Articles à valider -->
        <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-yellow-400 to-orange-500 opacity-10 blur-2xl rounded-full group-hover:opacity-20 transition-opacity"></div>
            
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Articles en attente</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $stats['pending_posts'] }}</h3>
                </div>
                <div class="p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-xl text-yellow-600 dark:text-yellow-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
            </div>
            
            <div class="mt-4 flex items-center text-xs">
                <span class="text-yellow-600 dark:text-yellow-400 font-medium bg-yellow-100 dark:bg-yellow-900/30 px-2 py-1 rounded-md">
                    Action requise
                </span>
                <span class="ml-2 text-gray-400">Validation nécessaire</span>
            </div>
        </div>

        <!-- Carte 2 : Prêtres -->
        <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 opacity-10 blur-2xl rounded-full group-hover:opacity-20 transition-opacity"></div>
            
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Prêtres inscrits</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $stats['priests_count'] }}</h3>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-xl text-kamina-blue dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            
            <div class="mt-4 flex items-center text-xs">
                <span class="text-green-600 dark:text-green-400 font-medium flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Actifs
                </span>
                <span class="ml-2 text-gray-400">sur le diocèse</span>
            </div>
        </div>

        <!-- Carte 3 : Paroisses -->
        <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-green-400 to-emerald-600 opacity-10 blur-2xl rounded-full group-hover:opacity-20 transition-opacity"></div>
            
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Paroisses</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $stats['parishes_count'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-xl text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>
            
            <div class="mt-4 flex items-center text-xs">
                <span class="text-gray-400">Réparties sur le territoire</span>
            </div>
        </div>

        <!-- Carte 4 : Musique -->
        <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-600 opacity-10 blur-2xl rounded-full group-hover:opacity-20 transition-opacity"></div>
            
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Chants à valider</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $stats['pending_songs'] }}</h3>
                </div>
                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-xl text-purple-600 dark:text-purple-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                </div>
            </div>
            
            <div class="mt-4 flex items-center text-xs">
                <a href="#" class="text-purple-600 dark:text-purple-400 hover:underline">Gérer la discothèque →</a>
            </div>
        </div>
    </div>

    <!-- 3. TABLEAU RÉCENT (Design KBH) -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        
        <!-- Header du Tableau -->
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800">
            <div class="flex items-center gap-2">
                <div class="h-8 w-1 bg-kamina-blue rounded-full"></div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">Dernières publications</h3>
            </div>
            <a href="#" class="text-sm font-medium text-kamina-blue dark:text-kamina-gold hover:text-blue-700 dark:hover:text-yellow-500 transition-colors flex items-center gap-1">
                Voir tout
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <!-- Le Tableau -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-xs tracking-wider">
                        <th class="py-4 px-6 font-semibold">Titre</th>
                        <th class="py-4 px-6 font-semibold">Auteur</th>
                        <th class="py-4 px-6 text-center font-semibold">Date</th>
                        <th class="py-4 px-6 text-center font-semibold">Statut</th>
                        <th class="py-4 px-6 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($recentPosts as $post)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200 group">
                        
                        <!-- Titre + Catégorie -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800 dark:text-gray-200 group-hover:text-kamina-blue dark:group-hover:text-kamina-gold transition-colors">
                                    {{ Str::limit($post->title, 40) }}
                                </span>
                                <span class="text-xs text-gray-400">{{ $post->category->name ?? 'Général' }}</span>
                            </div>
                        </td>

                        <!-- Auteur -->
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-xs font-bold text-gray-600 dark:text-gray-200 ring-2 ring-white dark:ring-gray-800">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <span class="ml-3 text-sm text-gray-600 dark:text-gray-300 font-medium">{{ $post->user->name }}</span>
                            </div>
                        </td>

                        <!-- Date -->
                        <td class="py-4 px-6 text-center">
                            <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700/50 px-2 py-1 rounded-md">
                                {{ $post->created_at->format('d/m/Y') }}
                            </span>
                        </td>

                        <!-- Statut (Badges Modernes) -->
                        <td class="py-4 px-6 text-center">
                            @if($post->status === 'published')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Publié
                                </span>
                            @elseif($post->status === 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5 animate-pulse"></span>
                                    En attente
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                    Brouillon
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 rounded-lg text-gray-400 hover:text-kamina-blue hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </button>
                                <button class="p-1.5 rounded-lg text-gray-400 hover:text-kamina-gold hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500 dark:text-gray-400 flex flex-col items-center justify-center">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-3 mb-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <p>Aucune publication récente.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>