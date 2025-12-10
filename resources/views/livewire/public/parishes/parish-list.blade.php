<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- En-tête de section -->
        <div class="text-center mb-12">
            <h2 class="text-base font-semibold text-kamina-gold tracking-wide uppercase">Diocèse de Kamina</h2>
            <p class="mt-1 text-4xl font-extrabold text-kamina-blue sm:text-5xl sm:tracking-tight lg:text-6xl font-playfair">
                Nos Paroisses
            </p>
            <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">
                Trouvez une église près de chez vous, consultez les horaires des messes et participez à la vie communautaire.
            </p>
        </div>

        <!-- Barre de recherche -->
        <div class="max-w-lg mx-auto mb-12">
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="focus:ring-kamina-gold focus:border-kamina-gold block w-full pl-10 sm:text-sm border-gray-300 rounded-full py-3" placeholder="Rechercher une paroisse, une ville...">
            </div>
        </div>

        <!-- Grille des paroisses -->
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($parishes as $parish)
                <div class="flex flex-col bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                    
                    <!-- Image -->
                    <div class="flex-shrink-0 relative h-48 w-full overflow-hidden">
                        @if($parish->photo_path)
                            <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('storage/'.$parish->photo_path) }}" alt="{{ $parish->name }}">
                        @else
                            <div class="h-full w-full bg-kamina-blue flex items-center justify-center">
                                <svg class="h-16 w-16 text-white opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-kamina-blue uppercase tracking-wider shadow-sm">
                            {{ $parish->city }}
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <a href="{{ route('public.parishes.show', $parish->id) }}" class="block mt-2">
                                <p class="text-xl font-bold text-gray-900 group-hover:text-kamina-gold transition-colors">{{ $parish->name }}</p>
                                <p class="mt-3 text-base text-gray-500 line-clamp-2">
                                    {{ strip_tags($parish->history ?? 'Aucune description disponible.') }}
                                </p>
                            </a>
                        </div>
                        
                        <!-- Footer carte -->
                        <div class="mt-6 flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                {{ Str::limit($parish->address, 25) }}
                            </div>
                            <a href="{{ route('public.parishes.show', $parish->id) }}" class="text-sm font-medium text-kamina-blue hover:text-kamina-gold transition-colors flex items-center">
                                Voir détails <span aria-hidden="true" class="ml-1">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">Aucune paroisse ne correspond à votre recherche.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $parishes->links() }}
        </div>
    </div>
</div>