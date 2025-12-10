<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- En-tête -->
        <div class="text-center mb-12">
            <span class="text-kamina-gold font-bold tracking-widest uppercase text-sm">Patrimoine Musical</span>
            <h1 class="text-4xl md:text-5xl font-bold font-playfair text-kamina-blue mt-2 mb-4">
                Chants & Liturgie
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Accédez aux partitions et audios des chants de notre diocèse pour animer vos célébrations.
            </p>
        </div>

        <!-- Barre d'outils (Recherche & Filtres) -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
            
            <!-- Filtre Moment Liturgique -->
            <div class="flex overflow-x-auto pb-2 md:pb-0 gap-2 w-full md:w-auto no-scrollbar mask-gradient">
                <button wire:click="$set('moment', '')" 
                        class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition {{ $moment == '' ? 'bg-kamina-blue text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Tout
                </button>
                @foreach($moments as $m)
                    <button wire:click="$set('moment', '{{ $m }}')" 
                            class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition {{ $moment == $m ? 'bg-kamina-gold text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $m }}
                    </button>
                @endforeach
            </div>

            <!-- Recherche -->
            <div class="relative w-full md:w-72 flex-shrink-0">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher un titre, un auteur..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-full border border-gray-300 focus:ring-kamina-gold focus:border-kamina-gold text-sm shadow-sm">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <!-- Grille des Chants -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($songs as $song)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                    
                    <!-- Header Carte -->
                    <div class="p-6 pb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="inline-block px-2 py-1 rounded text-xs font-bold bg-blue-50 text-kamina-blue mb-2">
                                    {{ $song->liturgical_moment }}
                                </span>
                                <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">{{ $song->title }}</h3>
                                <p class="text-sm text-gray-500">
                                    <span class="italic">Comp.</span> {{ $song->composer ?? 'Inconnu' }}
                                </p>
                            </div>
                            <div class="h-10 w-10 bg-kamina-gold/10 text-kamina-gold rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Lecteur Audio (Si dispo) -->
                    @if($song->audio_path)
                        <div class="px-6 py-2 bg-gray-50 border-t border-b border-gray-100">
                            <audio controls class="w-full h-8" controlsList="nodownload">
                                <source src="{{ asset('storage/' . $song->audio_path) }}" type="audio/mpeg">
                                Votre navigateur ne supporte pas l'audio.
                            </audio>
                        </div>
                    @else
                        <div class="px-6 py-3 bg-gray-50 border-t border-b border-gray-100 text-xs text-gray-400 italic text-center">
                            Audio non disponible
                        </div>
                    @endif

                    <!-- Footer Actions -->
                    <div class="px-6 py-4 mt-auto flex items-center justify-between">
                        <!-- Bouton Partition -->
                        @if($song->score_path)
                            <a href="{{ asset('storage/' . $song->score_path) }}" target="_blank" 
                               class="flex items-center gap-2 text-sm font-bold text-red-600 hover:text-red-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                Partition
                            </a>
                        @else
                            <span class="text-sm text-gray-300 cursor-not-allowed flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                Partition
                            </span>
                        @endif

                        <!-- Bouton Voir Paroles (Optionnel, pourrait ouvrir une modale) -->
                        @if(!empty($song->lyrics))
                            <button class="text-sm text-gray-500 hover:text-kamina-blue transition underline decoration-dotted">
                                Paroles
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 py-12 text-center">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-3 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <p class="text-gray-500">Aucun chant ne correspond à votre recherche.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $songs->links() }}
        </div>
    </div>
</div>