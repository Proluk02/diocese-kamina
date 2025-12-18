<div class="bg-brand-light dark:bg-gray-900 min-h-screen transition-colors duration-300" 
     x-data="{ 
        currentAudio: null, 
        currentTitle: '', 
        currentComposer: '', 
        isPlaying: false,
        showDetail: false,
        detailSong: null, 

        playSong(url, title, composer) {
            // Si on change de chanson
            if (this.currentAudio !== url) {
                this.currentAudio = url;
                this.currentTitle = title;
                this.currentComposer = composer;
                this.$refs.audioPlayer.src = url;
                this.$refs.audioPlayer.load();
                this.$refs.audioPlayer.play();
                this.isPlaying = true;
            } else {
                // Si on met en pause/play la même chanson
                if (this.isPlaying) {
                    this.$refs.audioPlayer.pause();
                    this.isPlaying = false;
                } else {
                    this.$refs.audioPlayer.play();
                    this.isPlaying = true;
                }
            }
        },
        
        pauseSong() {
            this.$refs.audioPlayer.pause();
            this.isPlaying = false;
        },

        openDetail(song) {
            this.detailSong = song;
            this.showDetail = true;
        }
     }">

    <!-- HERO HEADER -->
    <div class="relative bg-gray-900 overflow-hidden py-20 border-b border-gray-800">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-blue-900/40 to-gray-900"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold font-playfair text-white mb-4">
                Répertoire <span class="text-kamina-gold">Liturgique</span>
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Explorez notre patrimoine musical : partitions, audios et paroles pour la gloire de Dieu.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-32">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- SIDEBAR FILTRES (ACCORDÉON) -->
            <div class="w-full lg:w-72 flex-shrink-0 space-y-6" data-aos="fade-right">
                
                <!-- Recherche Globale -->
                <div class="relative">
                    <input wire:model.live.debounce.500ms="search" type="text" placeholder="Titre, compositeur..." 
                           class="w-full pl-11 pr-4 py-3 rounded-xl border-none bg-white dark:bg-gray-800 shadow-sm focus:ring-2 focus:ring-kamina-gold text-gray-900 dark:text-white placeholder-gray-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    
                    <!-- Indicateur de chargement recherche -->
                    <div wire:loading wire:target="search" class="absolute right-3 top-3.5">
                        <svg class="animate-spin h-5 w-5 text-kamina-gold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </div>
                </div>

                <!-- Filtres Accordéon -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden" x-data="{ activeGroup: 'moments' }">
                    
                    <!-- 1. Parties de la Messe -->
                    <div class="border-b border-gray-100 dark:border-gray-700">
                        <button @click="activeGroup = activeGroup === 'moments' ? null : 'moments'" class="w-full flex justify-between items-center p-4 text-left font-bold text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <span>Parties de la Messe</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="activeGroup === 'moments' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="activeGroup === 'moments'" x-collapse class="bg-gray-50/50 dark:bg-gray-800/50 p-3 space-y-1">
                            <label class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-white dark:hover:bg-gray-700 cursor-pointer">
                                <input type="radio" wire:model.live="filterMoment" value="" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                <span class="text-sm text-gray-600 dark:text-gray-300">Tout afficher</span>
                            </label>
                            @foreach($moments as $m)
                                <label class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-white dark:hover:bg-gray-700 cursor-pointer">
                                    <input type="radio" wire:model.live="filterMoment" value="{{ $m }}" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $m }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Temps Liturgiques -->
                    <div class="border-b border-gray-100 dark:border-gray-700">
                        <button @click="activeGroup = activeGroup === 'seasons' ? null : 'seasons'" class="w-full flex justify-between items-center p-4 text-left font-bold text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <span>Temps Liturgiques</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="activeGroup === 'seasons' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="activeGroup === 'seasons'" x-collapse class="bg-gray-50/50 dark:bg-gray-800/50 p-3 space-y-1">
                            <label class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-white dark:hover:bg-gray-700 cursor-pointer">
                                <input type="radio" wire:model.live="filterSeason" value="" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                <span class="text-sm text-gray-600 dark:text-gray-300">Tous les temps</span>
                            </label>
                            @foreach($seasons as $s)
                                <label class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-white dark:hover:bg-gray-700 cursor-pointer">
                                    <input type="radio" wire:model.live="filterSeason" value="{{ $s }}" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $s }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. Thèmes -->
                    <div>
                        <button @click="activeGroup = activeGroup === 'themes' ? null : 'themes'" class="w-full flex justify-between items-center p-4 text-left font-bold text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <span>Thèmes & Fêtes</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="activeGroup === 'themes' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="activeGroup === 'themes'" x-collapse class="bg-gray-50/50 dark:bg-gray-800/50 p-3 space-y-1">
                            <label class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-white dark:hover:bg-gray-700 cursor-pointer">
                                <input type="radio" wire:model.live="filterTheme" value="" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                <span class="text-sm text-gray-600 dark:text-gray-300">Tous les thèmes</span>
                            </label>
                            @foreach($themes as $t)
                                <label class="flex items-center gap-2 px-2 py-1.5 rounded hover:bg-white dark:hover:bg-gray-700 cursor-pointer">
                                    <input type="radio" wire:model.live="filterTheme" value="{{ $t }}" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $t }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Bouton Reset -->
                @if($filterMoment || $filterSeason || $filterTheme || $search)
                    <button wire:click="resetFilters" class="w-full py-2 text-sm text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition border border-dashed border-red-200 dark:border-red-800">
                        Effacer les filtres
                    </button>
                @endif
            </div>

            <!-- RESULTATS -->
            <div class="flex-1 space-y-4">
                <div class="flex justify-between items-center mb-2 px-2">
                    <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ $songs->total() }} Résultats</h2>
                </div>

                <!-- LISTE DES CHANTS -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden divide-y divide-gray-100 dark:divide-gray-700">
                    
                    @forelse($songs as $song)
                        <!-- AJOUT DE wire:key POUR ÉVITER LES CONFLITS DOM -->
                        <div wire:key="song-{{ $song->id }}" 
                             class="p-4 hover:bg-blue-50/50 dark:hover:bg-gray-700/50 transition duration-200 group flex flex-col sm:flex-row sm:items-center gap-4">
                            
                            <!-- 1. Play & Icon -->
                            <div class="flex-shrink-0">
                                @if($song->audio_path)
                                    <button @click="playSong('{{ asset('storage/'.$song->audio_path) }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->composer) }}')" 
                                            class="w-12 h-12 rounded-full bg-kamina-blue text-white flex items-center justify-center hover:bg-kamina-gold shadow-md transition-all group-hover:scale-110 focus:outline-none"
                                            :class="currentAudio === '{{ asset('storage/'.$song->audio_path) }}' && isPlaying ? 'bg-kamina-gold animate-pulse' : ''">
                                        
                                        <!-- Icone Play -->
                                        <svg x-show="currentAudio !== '{{ asset('storage/'.$song->audio_path) }}' || !isPlaying" class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <!-- Icone Pause -->
                                        <svg x-show="currentAudio === '{{ asset('storage/'.$song->audio_path) }}' && isPlaying" x-cloak class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </button>
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-300 dark:text-gray-500 flex items-center justify-center cursor-not-allowed">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <!-- 2. Titre & Infos -->
                            <div class="flex-1 min-w-0 cursor-pointer" @click="openDetail({{ json_encode($song) }})">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white truncate group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors">
                                    {{ $song->title }}
                                </h4>
                                <div class="flex flex-wrap items-center gap-y-1 gap-x-3 text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> 
                                        {{ $song->composer ?? 'Anonyme' }}
                                    </span>
                                    <span class="text-gray-300">|</span>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $song->liturgical_moment }}</span>
                                    @if($song->liturgical_season)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">{{ $song->liturgical_season }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- 3. Actions Rapides -->
                            <div class="flex items-center gap-2">
                                <button @click="openDetail({{ json_encode($song) }})" class="hidden sm:inline-flex px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs font-bold uppercase rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                    Détails
                                </button>
                                @if($song->score_path)
                                    <a href="{{ route('download.song', ['id' => $song->id, 'type' => 'score']) }}" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition" title="Partition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <p class="text-gray-500 text-lg">Aucun chant ne correspond aux critères.</p>
                            <button wire:click="resetFilters" class="mt-4 text-kamina-blue hover:underline text-sm font-bold">Voir tous les chants</button>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $songs->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- MODALE DÉTAIL (Overlay) -->
    <div x-show="showDetail" style="display: none;" 
         class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="showDetail" x-transition.opacity class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" @click="showDetail = false"></div>

        <!-- Panel -->
        <div x-show="showDetail" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-gray-100 dark:border-gray-700" 
                 @click.stop>
                
                <!-- Close Button -->
                <button @click="showDetail = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Colonne Gauche : Infos & Média -->
                    <div class="bg-gray-50 dark:bg-gray-900 p-8 flex flex-col justify-center text-center md:text-left">
                        <span class="inline-block px-3 py-1 rounded-full bg-kamina-blue/10 text-kamina-blue dark:text-blue-300 text-xs font-bold uppercase tracking-wide mb-4 w-fit mx-auto md:mx-0" x-text="detailSong?.liturgical_moment"></span>
                        
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 font-playfair" x-text="detailSong?.title"></h2>
                        <p class="text-lg text-kamina-gold font-medium mb-6" x-text="detailSong?.composer"></p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-8 justify-center md:justify-start">
                            <span class="px-3 py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300" x-show="detailSong?.liturgical_season" x-text="detailSong?.liturgical_season"></span>
                            <span class="px-3 py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300" x-show="detailSong?.theme" x-text="detailSong?.theme"></span>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-3">
                            <!-- Play -->
                            <button x-show="detailSong?.audio_path"
                                    @click="playSong('/storage/'+detailSong.audio_path, detailSong.title, detailSong.composer)"
                                    class="w-full py-3 bg-kamina-blue hover:bg-blue-800 text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                Écouter l'audio
                            </button>
                            
                            <!-- Partition -->
                            <a x-show="detailSong?.score_path"
                               :href="'/download/song/' + detailSong?.id + '/score'"
                               class="w-full py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-xl font-bold flex items-center justify-center gap-2 transition">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                Télécharger la partition
                            </a>
                        </div>
                    </div>

                    <!-- Colonne Droite : Paroles & Bio -->
                    <div class="p-8 max-h-[60vh] overflow-y-auto custom-scrollbar">
                        <!-- Paroles -->
                        <div x-show="detailSong?.lyrics">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Paroles</h3>
                            <div class="prose dark:prose-invert text-gray-700 dark:text-gray-300 text-sm leading-relaxed" x-html="detailSong?.lyrics"></div>
                        </div>

                        <!-- Bio Compositeur -->
                        <div x-show="detailSong?.composer_description" class="mt-8 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">À propos du compositeur</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 italic" x-text="detailSong?.composer_description"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PLAYER AUDIO STICKY (Identique précédent) -->
    <div x-show="currentAudio" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-full opacity-0"
         class="fixed bottom-0 left-0 w-full bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border-t border-gray-200 dark:border-gray-800 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-50 p-4"
         x-cloak>
        
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-4 md:gap-8">
            
            <!-- Info morceau -->
            <div class="w-full md:w-1/4 flex items-center gap-4">
                <div class="h-12 w-12 bg-kamina-gold rounded-xl flex items-center justify-center text-white shadow-lg animate-pulse" :class="{ 'animate-pulse': isPlaying }">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-900 dark:text-white truncate text-sm md:text-base" x-text="currentTitle"></h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="currentComposer"></p>
                </div>
            </div>

            <!-- Controls (Custom Style via CSS) -->
            <div class="w-full md:flex-1">
                <audio x-ref="audioPlayer" controls class="w-full h-10 accent-kamina-gold" 
                       @play="isPlaying = true" @pause="isPlaying = false" @ended="isPlaying = false">
                </audio>
            </div>

            <!-- Close -->
            <div class="w-auto flex justify-end">
                <button @click="pauseSong(); currentAudio = null" class="text-gray-400 hover:text-red-500 p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>

</div>