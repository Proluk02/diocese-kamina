<div class="bg-brand-light dark:bg-gray-900 min-h-screen transition-colors duration-300" 
     x-data="{ 
        currentAudio: null, 
        currentTitle: '', 
        currentComposer: '', 
        isPlaying: false,
        showDetail: false,
        detailSong: null,
        
        playSong(url, title, composer) {
            if (this.currentAudio !== url) {
                this.currentAudio = url;
                this.currentTitle = title;
                this.currentComposer = composer;
                this.$refs.audioPlayer.src = url;
                this.$refs.audioPlayer.load();
                this.$refs.audioPlayer.play();
                this.isPlaying = true;
            } else {
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

    <!-- HERO HEADER (Statique, sans AOS pour la stabilité) -->
    <div class="relative bg-gray-900 overflow-hidden py-24 border-b border-gray-800">
        <div class="absolute inset-0 bg-gradient-to-r from-kamina-blue to-blue-900 opacity-90"></div>
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <div class="inline-flex items-center gap-2 text-kamina-gold text-xs font-bold uppercase tracking-widest mb-4 bg-white/10 px-4 py-1.5 rounded-full backdrop-blur-sm border border-white/10">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Médiathèque Musicale
            </div>
            <h1 class="text-4xl md:text-6xl font-bold font-playfair text-white mb-6">
                Chants & <span class="text-kamina-gold">Liturgie</span>
            </h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto font-light leading-relaxed">
                Une bibliothèque de chants sacrés, partitions et audios pour animer nos célébrations.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-40">
        <div class="flex flex-col lg:flex-row gap-8 relative">
            
            <!-- SIDEBAR FILTRES (STICKY) -->
            <div class="w-full lg:w-72 flex-shrink-0 space-y-6 lg:sticky lg:top-28 self-start h-fit z-30">
                
                <!-- Recherche (Livewire) -->
                <div class="relative group">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Titre, compositeur..." 
                           class="w-full pl-11 pr-4 py-3 rounded-2xl border-none bg-white dark:bg-gray-800 shadow-sm focus:ring-2 focus:ring-kamina-gold text-gray-900 dark:text-white placeholder-gray-500 transition-all">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-3.5 group-focus-within:text-kamina-blue transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    
                    <!-- Loader -->
                    <div wire:loading wire:target="search" class="absolute right-3 top-3.5">
                        <svg class="animate-spin h-5 w-5 text-kamina-gold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </div>
                </div>

                <!-- Filtres Accordéon -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden" x-data="{ activeGroup: 'moments' }">
                    
                    <!-- 1. Parties de la Messe -->
                    <div class="border-b border-gray-100 dark:border-gray-700">
                        <button @click="activeGroup = activeGroup === 'moments' ? null : 'moments'" class="w-full flex justify-between items-center p-5 text-left font-bold text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-kamina-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg> Parties de la Messe</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="activeGroup === 'moments' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="activeGroup === 'moments'" x-collapse class="bg-gray-50/50 dark:bg-gray-800/50 p-3 space-y-1">
                            <label class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white dark:hover:bg-gray-700 cursor-pointer transition">
                                <input type="radio" wire:model.live="filterMoment" value="" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Tout afficher</span>
                            </label>
                            @foreach($moments as $m)
                                <label class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white dark:hover:bg-gray-700 cursor-pointer transition">
                                    <input type="radio" wire:model.live="filterMoment" value="{{ $m }}" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $m }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Temps Liturgiques -->
                    <div class="border-b border-gray-100 dark:border-gray-700">
                        <button @click="activeGroup = activeGroup === 'seasons' ? null : 'seasons'" class="w-full flex justify-between items-center p-5 text-left font-bold text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Temps Liturgiques</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="activeGroup === 'seasons' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="activeGroup === 'seasons'" x-collapse class="bg-gray-50/50 dark:bg-gray-800/50 p-3 space-y-1">
                            <label class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white dark:hover:bg-gray-700 cursor-pointer transition">
                                <input type="radio" wire:model.live="filterSeason" value="" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Tous les temps</span>
                            </label>
                            @foreach($seasons as $s)
                                <label class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white dark:hover:bg-gray-700 cursor-pointer transition">
                                    <input type="radio" wire:model.live="filterSeason" value="{{ $s }}" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $s }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. Thèmes -->
                    <div>
                        <button @click="activeGroup = activeGroup === 'themes' ? null : 'themes'" class="w-full flex justify-between items-center p-5 text-left font-bold text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg> Thèmes</span>
                            <svg class="w-4 h-4 transform transition-transform" :class="activeGroup === 'themes' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="activeGroup === 'themes'" x-collapse class="bg-gray-50/50 dark:bg-gray-800/50 p-3 space-y-1">
                            <label class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white dark:hover:bg-gray-700 cursor-pointer transition">
                                <input type="radio" wire:model.live="filterTheme" value="" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                <span class="text-sm text-gray-600 dark:text-gray-300">Tous les thèmes</span>
                            </label>
                            @foreach($themes as $t)
                                <label class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white dark:hover:bg-gray-700 cursor-pointer transition">
                                    <input type="radio" wire:model.live="filterTheme" value="{{ $t }}" class="text-kamina-gold focus:ring-kamina-gold bg-gray-100 border-gray-300">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $t }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Bouton Reset -->
                @if($filterMoment || $filterSeason || $filterTheme || $search)
                    <button wire:click="resetFilters" class="w-full py-3 text-sm font-bold text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition border border-dashed border-red-200 dark:border-red-800 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Effacer les filtres
                    </button>
                @endif
            </div>

            <!-- RESULTATS -->
            <div class="flex-1 space-y-6">
                
                <div class="flex justify-between items-center px-2">
                    <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ $songs->total() }} Résultats</h2>
                </div>

                <!-- LISTE DES CHANTS -->
                <div class="bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden divide-y divide-gray-100 dark:divide-gray-700">
                    
                    @forelse($songs as $song)
                        <!-- wire:key UNIQUE est essentiel pour que Livewire ne perde pas le fil -->
                        <div wire:key="song-item-{{ $song->id }}" 
                             class="p-5 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition duration-200 group flex flex-col sm:flex-row sm:items-center gap-5 cursor-pointer"
                             @click="openDetail({{ json_encode($song) }})">
                            
                            <!-- 1. Icone -->
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 flex items-center justify-center group-hover:bg-kamina-blue group-hover:text-white transition-colors duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                                </div>
                            </div>

                            <!-- 2. Titre & Infos -->
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white truncate group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors">
                                    {{ $song->title }}
                                </h4>
                                <div class="flex flex-wrap items-center gap-y-1 gap-x-3 text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <span class="flex items-center gap-1 font-medium">
                                        <svg class="w-3.5 h-3.5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> 
                                        {{ $song->composer ?? 'Anonyme' }}
                                    </span>
                                    <span class="text-gray-300 dark:text-gray-600">|</span>
                                    <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $song->liturgical_moment }}</span>
                                </div>
                            </div>

                            <!-- 3. Badges -->
                            <div class="flex items-center gap-2">
                                @if($song->audio_path)
                                    <span class="px-2 py-1 bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 rounded text-xs font-bold border border-blue-100 dark:border-blue-800">Audio</span>
                                @endif
                                @if($song->score_path)
                                    <span class="px-2 py-1 bg-red-50 text-red-600 dark:bg-red-900/30 dark:text-red-400 rounded text-xs font-bold border border-red-100 dark:border-red-800">PDF</span>
                                @endif
                                <svg class="w-5 h-5 text-gray-300 group-hover:text-kamina-gold transition-colors ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    @empty
                        <div class="p-16 text-center">
                            <p class="text-gray-500 dark:text-gray-400 text-lg">Aucun chant trouvé.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $songs->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- MODALE DÉTAIL VERTICALE (Overlay) -->
    <div x-show="showDetail" style="display: none;" 
         class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="showDetail" x-transition.opacity class="fixed inset-0 bg-gray-900/90 backdrop-blur-md transition-opacity" @click="showDetail = false"></div>

        <!-- Panel -->
        <div x-show="showDetail" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8"
             class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            
            <div class="relative transform overflow-hidden rounded-[2rem] bg-white dark:bg-gray-800 text-left shadow-2xl transition-all w-full max-w-2xl border border-gray-100 dark:border-gray-700 flex flex-col max-h-[85vh]" 
                 @click.stop>
                
                <!-- Close Button -->
                <button @click="showDetail = false" class="absolute top-4 right-4 z-20 bg-gray-100 dark:bg-gray-700 text-gray-500 hover:text-gray-900 dark:hover:text-white p-2 rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- CORPS MODALE (Layout Vertical Unique) -->
                <div class="p-8 md:p-10 overflow-y-auto custom-scrollbar">
                    
                    <!-- 1. En-tête Centré -->
                    <div class="text-center mb-10">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-kamina-blue/10 text-kamina-blue dark:text-blue-300 text-xs font-bold uppercase tracking-widest mb-4" x-text="detailSong?.liturgical_moment"></span>
                        
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2 font-playfair leading-tight" x-text="detailSong?.title"></h2>
                        <p class="text-lg text-kamina-gold font-medium" x-text="detailSong?.composer"></p>

                        <div class="flex flex-wrap justify-center gap-2 mt-4">
                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300" x-show="detailSong?.liturgical_season" x-text="detailSong?.liturgical_season"></span>
                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300" x-show="detailSong?.theme" x-text="detailSong?.theme"></span>
                        </div>
                    </div>

                    <!-- 2. Action Audio -->
                    <div x-show="detailSong?.audio_path" class="mb-10 flex justify-center">
                        <button @click="playSong('/storage/'+detailSong.audio_path, detailSong.title, detailSong.composer)"
                                class="w-full md:w-auto px-10 py-4 bg-kamina-blue hover:bg-blue-800 text-white rounded-2xl font-bold shadow-lg shadow-blue-500/30 flex items-center justify-center gap-3 transition-all hover:-translate-y-1 transform">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            <span class="text-lg">Écouter le chant</span>
                        </button>
                    </div>

                    <!-- 3. Prévisualisation Partition (Iframe Direct) -->
                    <div x-show="detailSong?.score_path" class="mb-10">
                        <div class="flex items-center justify-between mb-4 px-1">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Aperçu Partition
                            </h4>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 h-[500px] shadow-inner relative group">
                            <iframe :src="'/storage/' + detailSong?.score_path" class="w-full h-full" frameborder="0"></iframe>
                            
                            <!-- Bouton agrandir (optionnel) -->
                            <a :href="'/storage/' + detailSong?.score_path" target="_blank" class="absolute top-4 right-4 bg-white/90 text-gray-800 p-2 rounded-lg shadow-md hover:bg-white transition opacity-0 group-hover:opacity-100" title="Ouvrir dans un nouvel onglet">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 4. Boutons Téléchargement -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-12 border-t border-gray-100 dark:border-gray-700 pt-8">
                        <a x-show="detailSong?.score_path"
                           :href="'/download/song/' + detailSong?.id + '/score'"
                           class="flex items-center justify-center gap-2 px-6 py-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl font-bold text-gray-700 dark:text-white hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-200 dark:hover:border-red-800 hover:text-red-600 transition shadow-sm group">
                            <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            Télécharger Partition
                        </a>
                        
                        <a x-show="detailSong?.audio_path"
                           :href="'/download/song/' + detailSong?.id + '/audio'"
                           class="flex items-center justify-center gap-2 px-6 py-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl font-bold text-gray-700 dark:text-white hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-200 dark:hover:border-blue-800 hover:text-blue-600 transition shadow-sm group">
                            <svg class="w-6 h-6 text-blue-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Télécharger Audio
                        </a>
                    </div>

                    <!-- 5. Paroles -->
                    <div x-show="detailSong?.lyrics" class="bg-gray-50 dark:bg-gray-900/50 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 text-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-6 -mr-6 w-24 h-24 bg-kamina-gold/10 rounded-full blur-xl"></div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Paroles</h4>
                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 text-lg leading-relaxed font-serif" x-html="detailSong?.lyrics"></div>
                    </div>

                    <!-- Bio -->
                    <div x-show="detailSong?.composer_description" class="mt-8 text-center px-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                            <span class="font-bold">Note sur l'auteur :</span> <span x-text="detailSong?.composer_description"></span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- PLAYER AUDIO STICKY (Identique) -->
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
            <div class="w-full md:w-1/4 flex items-center gap-4">
                <div class="h-12 w-12 bg-kamina-gold rounded-xl flex items-center justify-center text-white shadow-lg animate-pulse" :class="{ 'animate-pulse': isPlaying }">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-900 dark:text-white truncate text-sm md:text-base" x-text="currentTitle"></h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="currentComposer"></p>
                </div>
            </div>

            <div class="w-full md:flex-1">
                <audio x-ref="audioPlayer" controls class="w-full h-10 accent-kamina-gold" @play="isPlaying = true" @pause="isPlaying = false" @ended="isPlaying = false"></audio>
            </div>

            <div class="w-auto flex justify-end">
                <button @click="pauseSong(); currentAudio = null" class="text-gray-400 hover:text-red-500 p-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
        </div>
    </div>
</div>