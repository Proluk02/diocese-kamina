<div class="space-y-6">
    
    <!-- 1. TITRE & BIENVENUE -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Vue d'ensemble</h2>
            <p class="text-sm text-gray-500">
                Bienvenue sur l'espace de gestion du Diocèse de Kamina.
            </p>
        </div>
        <div class="text-right">
            <span class="bg-kamina-blue text-white px-4 py-2 rounded-full text-sm font-semibold shadow">
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    <!-- 2. CARTES STATISTIQUES (GRID) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Carte 1 : Articles en attente (Important pour Admin) -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Articles à valider</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['pending_posts'] }}</p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
                <!-- Icone Crayon -->
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
        </div>

        <!-- Carte 2 : Prêtres -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-kamina-blue flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Prêtres inscrits</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['priests_count'] }}</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full text-kamina-blue">
                <!-- Icone Users -->
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <!-- Carte 3 : Paroisses -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Paroisses</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['parishes_count'] }}</p>
            </div>
            <div class="p-3 bg-green-100 rounded-full text-green-600">
                <!-- Icone Eglise -->
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
        </div>

        <!-- Carte 4 : Musique (Chants en attente) -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Chants à valider</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['pending_songs'] }}</p>
            </div>
            <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                <!-- Icone Musique -->
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
            </div>
        </div>
    </div>

    <!-- 3. TABLEAU RÉCENT (Dernières publications) -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Dernières publications</h3>
            <a href="#" class="text-sm text-kamina-blue hover:underline">Voir tout</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-xs leading-normal">
                        <th class="py-3 px-6 text-left">Titre</th>
                        <th class="py-3 px-6 text-left">Auteur</th>
                        <th class="py-3 px-6 text-center">Date</th>
                        <th class="py-3 px-6 text-center">Statut</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($recentPosts as $post)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <span class="font-medium">{{ Str::limit($post->title, 40) }}</span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <div class="mr-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <span>{{ $post->user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            {{ $post->created_at->format('d/m/Y') }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            @if($post->status === 'published')
                                <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Publié</span>
                            @elseif($post->status === 'pending')
                                <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs animate-pulse">En attente</span>
                            @else
                                <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs">Brouillon</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <button class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">Aucune publication récente.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>