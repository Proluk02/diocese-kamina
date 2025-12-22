<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- 1. EN-TÊTE COMPACT -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white font-playfair tracking-tight">
                Bonjour, {{ $user->name }}
            </h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Espace <span class="font-bold text-kamina-blue dark:text-blue-400 uppercase">{{ $user->role === 'bishop' ? 'Évêché' : ($user->role === 'musician' ? 'Musicien' : 'Administration') }}</span>
            </p>
        </div>
        
        <div class="flex items-center gap-3 bg-white dark:bg-gray-800 py-1.5 px-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">{{ now()->translatedFormat('d F Y') }}</span>
        </div>
    </div>

    <!-- 2. CARTES STATISTIQUES (Conditionnelles) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($stats as $stat)
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between hover:shadow-md transition-shadow duration-200">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $stat['label'] }}</p>
                    @if(isset($stat['is_text']) && $stat['is_text'])
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white truncate max-w-[150px]" title="{{ $stat['value'] }}">{{ $stat['value'] }}</h3>
                    @else
                        <h3 class="text-2xl font-bold {{ isset($stat['alert']) && $stat['value'] > 0 ? 'text-red-500' : 'text-gray-800 dark:text-white' }}">
                            {{ $stat['value'] }}
                        </h3>
                    @endif
                </div>
                
                <!-- Icone Compacte -->
                <div class="h-10 w-10 rounded-lg flex items-center justify-center 
                    {{ $stat['color'] == 'blue' ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : '' }}
                    {{ $stat['color'] == 'green' ? 'bg-green-50 text-green-600 dark:bg-green-900/20 dark:text-green-400' : '' }}
                    {{ $stat['color'] == 'yellow' ? 'bg-yellow-50 text-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-400' : '' }}
                    {{ $stat['color'] == 'purple' ? 'bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400' : '' }}">
                    
                    @if($stat['icon'] == 'users') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    @elseif($stat['icon'] == 'home') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    @elseif($stat['icon'] == 'pencil') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    @elseif($stat['icon'] == 'music') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                    @elseif($stat['icon'] == 'check') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    @elseif($stat['icon'] == 'clock') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @elseif($stat['icon'] == 'folder') <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    @else <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- 3. ACTIVITÉ RÉCENTE (CONDITIONNELLE) -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="font-bold text-gray-800 dark:text-white text-sm uppercase tracking-wide">
                @if($viewType === 'musician')
                    Vos derniers chants ajoutés
                @else
                    Publications Récentes
                @endif
            </h3>
            
            @if($viewType === 'musician')
                <a href="{{ route('admin.songs.index') }}" class="text-xs font-bold text-kamina-blue hover:underline">Tout voir</a>
            @else
                <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-kamina-blue hover:underline">Tout voir</a>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700/30 text-gray-400 text-[10px] uppercase font-bold">
                    <tr>
                        <th class="px-6 py-3">Titre</th>
                        @if($viewType !== 'musician') <th class="px-6 py-3">Auteur</th> @endif
                        <th class="px-6 py-3 text-center">Date</th>
                        <th class="px-6 py-3 text-center">Statut</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($recentItems as $item)
                    <tr class="hover:bg-blue-50/30 dark:hover:bg-gray-700/20 transition">
                        <td class="px-6 py-3">
                            <span class="font-bold text-gray-800 dark:text-white text-sm block truncate max-w-[200px]">
                                {{ $item->title }}
                            </span>
                            @if($viewType === 'musician')
                                <span class="text-xs text-gray-500">{{ $item->composer ?? '' }}</span>
                            @else
                                <span class="text-xs text-gray-500">{{ $item->category->name ?? 'Général' }}</span>
                            @endif
                        </td>
                        
                        @if($viewType !== 'musician')
                        <td class="px-6 py-3 text-xs text-gray-600 dark:text-gray-400">
                            {{ $item->user->name ?? 'Inconnu' }}
                        </td>
                        @endif

                        <td class="px-6 py-3 text-center text-xs text-gray-500">
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>
                        
                        <td class="px-6 py-3 text-center">
                            @php
                                // Adaptation statut Chant vs Article
                                $isApproved = $viewType === 'musician' ? $item->is_approved : ($item->status === 'published');
                                $isPending = $viewType === 'musician' ? !$item->is_approved : ($item->status === 'pending');

                                if ($isApproved) {
                                    $statusLabel = 'Publié';
                                    $statusColor = 'bg-green-100 text-green-700';
                                } elseif ($isPending) {
                                    $statusLabel = 'En attente';
                                    $statusColor = 'bg-yellow-100 text-yellow-700';
                                } else {
                                    $statusLabel = 'Brouillon';
                                    $statusColor = 'bg-gray-100 text-gray-600';
                                }
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-3 text-right">
                            @if($viewType === 'musician')
                                <a href="{{ route('admin.songs.index') }}" class="text-xs font-bold text-gray-400 hover:text-kamina-blue">Gérer</a>
                            @else
                                <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-gray-400 hover:text-kamina-blue">Gérer</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-400 text-sm italic">
                            Aucune activité récente.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>