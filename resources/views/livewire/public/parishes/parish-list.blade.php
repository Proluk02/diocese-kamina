<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold font-playfair text-kamina-blue mb-4">Nos Paroisses</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Trouvez une église, consultez les horaires des messes et rejoignez la communauté la plus proche de chez vous.</p>
        </div>

        <!-- Recherche & Filtres -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 mb-10 max-w-4xl mx-auto">
            <div class="flex-1 relative">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher une paroisse..." class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 focus:border-kamina-gold focus:ring-kamina-gold transition">
            </div>
            <div class="w-full md:w-64">
                <select wire:model.live="city" class="w-full py-3 px-4 rounded-xl border-gray-200 focus:border-kamina-gold focus:ring-kamina-gold">
                    <option value="">Toutes les villes</option>
                    @foreach($cities as $c) <option value="{{ $c }}">{{ $c }}</option> @endforeach
                </select>
            </div>
        </div>

        <!-- Grille -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($parishes as $parish)
                <a href="{{ route('parishes.public.show', $parish->id) }}" class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block h-full flex flex-col">
                    <!-- Photo -->
                    <div class="h-56 relative overflow-hidden bg-gray-200">
                        @if($parish->photo_path)
                            <img src="{{ asset('storage/' . $parish->photo_path) }}" alt="{{ $parish->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-4">
                            <span class="text-white text-xs font-bold uppercase tracking-wider bg-kamina-gold px-2 py-1 rounded">
                                {{ $parish->city }}
                            </span>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-kamina-blue transition">{{ $parish->name }}</h3>
                        <p class="text-gray-500 text-sm mb-4 flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ Str::limit($parish->address, 50) }}
                        </p>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center text-sm">
                            <span class="text-kamina-blue font-medium group-hover:underline">Voir les horaires</span>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-kamina-gold transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 py-12 text-center text-gray-500">
                    Aucune paroisse ne correspond à votre recherche.
                </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $parishes->links() }}</div>
    </div>
</div>