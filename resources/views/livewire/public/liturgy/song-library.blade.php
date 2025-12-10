<div class="bg-gray-50 min-h-screen" x-data="{ 
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
        }
        this.$refs.audioPlayer.play();
        this.isPlaying = true;
    },
    
    pauseSong() {
        this.$refs.audioPlayer.pause();
        this.isPlaying = false;
    }
}">

    <!-- Banner -->
    <div class="bg-kamina-blue py-16 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <h1 class="text-4xl font-bold font-playfair mb-4">Chants & Liturgie</h1>
            <p class="text-blue-100">Une bibliothèque de chants sacrés pour animer nos célébrations.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-32">
        
        <!-- Filtres -->
        <div class="flex flex-col lg:flex-row gap-8 mb-10">
            <!-- Sidebar Filtres -->
            <div class="w-full lg:w-64 flex-shrink-0 space-y-6">
                <!-- Recherche -->
                <div>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher un chant..." class="w-full pl-4 pr-4 py-3 rounded-xl border-gray-200 focus:border-kamina-gold focus:ring-kamina-gold shadow-sm text-sm">
                </div>

                <!-- Moments -->
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Moments Liturgiques</h3>
                    <div class="flex flex-wrap gap-2">
                        <button wire:click="filterByMoment('')" class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition {{ $moment === '' ? 'bg-kamina-blue text-white border-kamina-blue' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                            Tout
                        </button>
                        @foreach($moments as $m)
                            <button wire:click="filterByMoment('{{ $m }}')" class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition {{ $moment === $m ? 'bg-kamina-blue text-white border-kamina-blue' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                                {{ $m }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Liste des chants -->
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @forelse($songs as $song)
                        <div class="flex items-center p-4 border-b border-gray-100 hover:bg-blue-50/50 transition group">
                            
                            <!-- Play Button -->
                            <div class="mr-4">
                                @if($song->audio_path)
                                    <button @click="playSong('{{ asset('storage/'.$song->audio_path) }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->composer) }}')" 
                                            class="h-10 w-10 rounded-full bg-kamina-blue text-white flex items-center justify-center hover:bg-kamina-gold transition shadow-md group-hover:scale-110">
                                        <!-- Icone Play -->
                                        <svg x-show="currentAudio !== '{{ asset('storage/'.$song->audio_path) }}' || !isPlaying" class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <!-- Icone Pause (si en cours) -->
                                        <svg x-show="currentAudio === '{{ asset('storage/'.$song->audio_path) }}' && isPlaying" x-cloak class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </button>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center cursor-not-allowed">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Infos -->
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-900 text-lg truncate group-hover:text-kamina-blue transition">{{ $song->title }}</h4>
                                <div class="flex items-center text-sm text-gray-500 gap-3">
                                    <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> {{ $song->composer ?? 'Inconnu' }}</span>
                                    <span class="px-2 py-0.5 rounded-full bg-gray-100 text-xs font-semibold">{{ $song->liturgical_moment }}</span>
                                </div>
                            </div>

                            <!-- Actions (Download) -->
                            <div class="flex items-center gap-3">
                                @if($song->score_path)
                                    <a href="{{ asset('storage/'.$song->score_path) }}" target="_blank" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Télécharger la partition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </a>
                                @endif
                                @if($song->audio_path)
                                    <a href="{{ asset('storage/'.$song->audio_path) }}" download class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition" title="Télécharger l'audio">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-500">
                            Aucun chant trouvé.
                        </div>
                    @endforelse
                </div>
                <div class="mt-6">{{ $songs->links() }}</div>
            </div>
        </div>
    </div>

    <!-- PLAYER AUDIO STICKY (En bas) -->
    <div x-show="currentAudio" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-2xl z-50 p-4"
         x-cloak>
        <div class="max-w-7xl mx-auto flex items-center gap-4">
            <!-- Info morceau -->
            <div class="w-1/3 hidden md:block">
                <h4 class="font-bold text-gray-900 truncate" x-text="currentTitle"></h4>
                <p class="text-xs text-gray-500 truncate" x-text="currentComposer"></p>
            </div>

            <!-- Controls -->
            <div class="flex-1 flex justify-center">
                <audio x-ref="audioPlayer" controls class="w-full md:w-3/4 h-10" @play="isPlaying = true" @pause="isPlaying = false" @ended="isPlaying = false"></audio>
            </div>

            <!-- Close -->
            <div class="w-auto md:w-1/3 flex justify-end">
                <button @click="currentAudio = null; $refs.audioPlayer.pause()" class="text-gray-400 hover:text-red-500 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>

</div>