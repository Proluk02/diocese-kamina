<div class="bg-brand-light dark:bg-gray-900 min-h-screen transition-colors duration-300" 
     x-data="{ 
        currentAudio: null, 
        currentTitle: '', 
        currentComposer: '', 
        isPlaying: false,
        
        playSong(url, title, composer) {
            if (this.currentAudio !== url) {
                this.currentAudio = url;
                this.currentTitle = title;
                this.currentComposer = composer;
                this.$refs.audioPlayer.src = url;
                this.$refs.audioPlayer.load(); // Force rechargement
            }
            this.$refs.audioPlayer.play();
            this.isPlaying = true;
        },
        
        pauseSong() {
            this.$refs.audioPlayer.pause();
            this.isPlaying = false;
        }
     }">

    <!-- Header Page -->
    <div class="relative bg-gray-900 overflow-hidden py-24 mb-10">
        <div class="absolute inset-0 bg-gradient-to-r from-kamina-blue to-blue-900 opacity-90"></div>
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <!-- Décorations -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-kamina-gold/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 text-kamina-gold text-xs font-bold uppercase tracking-widest mb-4 bg-white/10 px-4 py-1.5 rounded-full backdrop-blur-sm border border-white/10">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Médiathèque Musicale
            </div>
            <h1 class="text-4xl md:text-6xl font-bold font-playfair text-white mb-6">
                Chants & <span class="text-kamina-gold">Liturgie</span>
            </h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto font-light leading-relaxed">
                Une bibliothèque de chants sacrés, partitions et audios pour animer nos célébrations et élever nos cœurs.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-32">
        
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filtres (Sticky) -->
            <div class="w-full lg:w-72 flex-shrink-0 space-y-6" data-aos="fade-right">
                
                <!-- Recherche -->
                <div class="relative group">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5 group-focus-within:text-kamina-blue transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher un chant..." 
                           class="w-full pl-11 pr-4 py-3 rounded-2xl border-none bg-white dark:bg-gray-800 shadow-sm focus:ring-2 focus:ring-kamina-gold text-gray-900 dark:text-white transition placeholder-gray-400">
                </div>

                <!-- Moments Liturgiques -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Moments Liturgiques
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <button wire:click="filterByMoment('')" 
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 border {{ $moment === '' ? 'bg-kamina-blue text-white border-kamina-blue shadow-md' : 'bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600' }}">
                            Tout
                        </button>
                        @foreach($moments as $m)
                            <button wire:click="filterByMoment('{{ $m }}')" 
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 border {{ $moment === $m ? 'bg-kamina-blue text-white border-kamina-blue shadow-md' : 'bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600' }}">
                                {{ $m }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <!-- Stats Rapides -->
                <div class="bg-gradient-to-br from-kamina-blue to-blue-800 p-6 rounded-3xl text-white shadow-lg text-center">
                    <p class="text-blue-200 text-xs font-bold uppercase tracking-wider mb-1">Total Bibliothèque</p>
                    <p class="text-4xl font-bold font-playfair">{{ $songs->total() }}</p>
                    <p class="text-sm opacity-80">Chants disponibles</p>
                </div>
            </div>

            <!-- Liste des chants -->
            <div class="flex-1 space-y-6" data-aos="fade-up">
                
                <div class="bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    @forelse($songs as $index => $song)
                        <div class="flex items-center p-5 border-b border-gray-100 dark:border-gray-700 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition duration-200 group {{ $loop->last ? 'border-b-0' : '' }}">
                            
                            <!-- Play Button -->
                            <div class="mr-5 flex-shrink-0">
                                @if($song->audio_path)
                                    <button @click="playSong('{{ asset('storage/'.$song->audio_path) }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->composer) }}')" 
                                            class="h-12 w-12 rounded-full flex items-center justify-center transition-all duration-300 shadow-md group-hover:scale-110 focus:outline-none"
                                            :class="currentAudio === '{{ asset('storage/'.$song->audio_path) }}' && isPlaying ? 'bg-kamina-gold text-white animate-pulse' : 'bg-kamina-blue text-white hover:bg-kamina-gold'">
                                        
                                        <!-- Icone Play -->
                                        <svg x-show="currentAudio !== '{{ asset('storage/'.$song->audio_path) }}' || !isPlaying" class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <!-- Icone Pause -->
                                        <svg x-show="currentAudio === '{{ asset('storage/'.$song->audio_path) }}' && isPlaying" x-cloak class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </button>
                                @else
                                    <div class="h-12 w-12 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-300 dark:text-gray-500 flex items-center justify-center cursor-not-allowed">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Infos -->
                            <div class="flex-1 min-w-0 pr-4">
                                <h4 class="font-bold text-gray-900 dark:text-white text-lg truncate group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors">
                                    {{ $song->title }}
                                </h4>
                                <div class="flex flex-wrap items-center text-sm text-gray-500 dark:text-gray-400 gap-3 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> 
                                        {{ $song->composer ?? 'Compositeur inconnu' }}
                                    </span>
                                    <span class="hidden sm:inline text-gray-300 dark:text-gray-600">•</span>
                                    <span class="px-2.5 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">
                                        {{ $song->liturgical_moment }}
                                    </span>
                                </div>
                            </div>

                            <!-- Actions (Download) -->
                            <div class="flex items-center gap-2">
                                @if($song->score_path)
                                    <a href="{{ asset('storage/'.$song->score_path) }}" target="_blank" 
                                       class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all duration-200" 
                                       title="Télécharger la partition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </a>
                                @endif
                                @if($song->audio_path)
                                    <a href="{{ asset('storage/'.$song->audio_path) }}" download 
                                       class="p-2.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all duration-200" 
                                       title="Télécharger l'audio">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4 text-gray-300 dark:text-gray-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Aucun chant trouvé pour cette recherche.</p>
                            <button wire:click="filterByMoment('')" class="mt-4 text-sm text-kamina-blue hover:underline">Réinitialiser les filtres</button>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($songs->hasPages())
                    <div class="mt-8 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-4 border border-gray-100 dark:border-gray-700">
                        {{ $songs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- PLAYER AUDIO STICKY (Glassmorphism) -->
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