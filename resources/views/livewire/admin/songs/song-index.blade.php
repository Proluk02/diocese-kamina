<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Chants Liturgiques</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Bibliothèque musicale, audios et partitions.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-kamina-blue hover:bg-blue-800 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
            Ajouter un Chant
        </button>
    </div>

    <!-- FILTRES -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row gap-4">
        <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></span>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold focus:border-kamina-gold transition-colors" placeholder="Rechercher un chant...">
        </div>
        <select wire:model.live="filterStatus" class="block w-full md:w-48 py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold focus:border-kamina-gold transition-colors">
            <option value="">Tous les états</option>
            <option value="approved">Validés</option>
            <option value="pending">En attente</option>
        </select>
    </div>

    <!-- TABLEAU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-xs">
                    <tr>
                        <th class="py-4 px-6 font-semibold">Titre</th>
                        <th class="py-4 px-6 font-semibold">Moment</th>
                        <th class="py-4 px-6 text-center font-semibold">Fichiers</th>
                        <th class="py-4 px-6 text-center font-semibold">Validation</th>
                        <th class="py-4 px-6 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($songs as $song)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                        <td class="py-4 px-6">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $song->title }}</span>
                                <span class="text-xs text-gray-500">{{ $song->composer ?? 'Compositeur inconnu' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                {{ $song->liturgical_moment }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex justify-center items-center gap-2">
                                @if($song->audio_path) 
                                    <span class="p-1 rounded bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400" title="Audio disponible">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>
                                    </span> 
                                @endif
                                @if($song->score_path) 
                                    <span class="p-1 rounded bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400" title="Partition disponible">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    </span> 
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button wire:click="toggleApproval({{ $song->id }})" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $song->is_approved ? 'bg-green-500' : 'bg-gray-200 dark:bg-gray-700' }}">
                                <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $song->is_approved ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="show({{ $song->id }})" class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg></button>
                                <button wire:click="edit({{ $song->id }})" class="p-2 text-gray-400 hover:text-kamina-gold hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                <button wire:click="delete({{ $song->id }})" wire:confirm="Supprimer ce chant ?" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-8 text-center text-gray-500">Aucun chant trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">{{ $songs->links() }}</div>
    </div>

    <!-- MODALE -->
    @if($isOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:w-full sm:max-w-2xl border border-gray-100 dark:border-gray-700 flex flex-col max-h-[90vh]">
                
                <!-- HEADER -->
                <div class="bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center shrink-0">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $mode === 'show' ? 'Détails du Chant' : ($mode === 'edit' ? 'Modifier Chant' : 'Nouveau Chant') }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>

                <!-- CORPS -->
                <div class="px-6 py-6 overflow-y-auto custom-scrollbar">
                    
                    @if($mode === 'show' && $currentSong)
                        <div class="space-y-6">
                            <!-- Info -->
                            <div class="text-center">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $currentSong->title }}</h2>
                                <p class="text-gray-500 dark:text-gray-400">{{ $currentSong->composer }} • {{ $currentSong->liturgical_moment }}</p>
                            </div>

                            <!-- Audio Player -->
                            @if($currentSong->audio_path)
                                <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-xl flex flex-col items-center">
                                    <p class="text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Écouter</p>
                                    <audio controls class="w-full">
                                        <source src="{{ asset('storage/'.$currentSong->audio_path) }}" type="audio/mpeg">
                                        Votre navigateur ne supporte pas l'audio.
                                    </audio>
                                </div>
                            @endif

                            <!-- Partition -->
                            @if($currentSong->score_path)
                                <div class="flex items-center justify-between p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-white dark:bg-red-800 p-2 rounded-lg text-red-500 shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 dark:text-white">Partition Disponible</h4>
                                            <p class="text-xs text-red-600 dark:text-red-300">Format PDF / Image</p>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/'.$currentSong->score_path) }}" target="_blank" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition">Télécharger</a>
                                </div>
                            @endif

                            <!-- Paroles -->
                            @if(!empty($currentSong->lyrics))
                                <div class="bg-gray-50 dark:bg-gray-900/30 p-6 rounded-xl border border-gray-100 dark:border-gray-700 text-center">
                                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Paroles</h4>
                                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                        {!! $currentSong->lyrics !!}
                                    </div>
                                </div>
                            @endif
                        </div>

                    @else
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Titre du chant</label>
                                    <input type="text" wire:model="title" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Compositeur</label>
                                    <input type="text" wire:model="composer" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Moment Liturgique</label>
                                <select wire:model="liturgical_moment" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                                    <option value="">Choisir...</option>
                                    @foreach($moments as $moment) <option value="{{ $moment }}">{{ $moment }}</option> @endforeach
                                </select>
                                @error('liturgical_moment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Upload Audio -->
                                <div class="bg-blue-50 dark:bg-blue-900/10 p-4 rounded-lg border border-dashed border-blue-300 dark:border-blue-700">
                                    <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">Fichier Audio (MP3)</label>
                                    <input type="file" wire:model="audioFile" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
                                    <div wire:loading wire:target="audioFile" class="text-xs text-blue-500 mt-1">Chargement...</div>
                                    @error('audioFile') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Upload Partition -->
                                <div class="bg-red-50 dark:bg-red-900/10 p-4 rounded-lg border border-dashed border-red-300 dark:border-red-700">
                                    <label class="block text-sm font-semibold text-red-800 dark:text-red-300 mb-2">Partition (PDF/Image)</label>
                                    <input type="file" wire:model="scoreFile" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-100 file:text-red-700 hover:file:bg-red-200">
                                    <div wire:loading wire:target="scoreFile" class="text-xs text-red-500 mt-1">Chargement...</div>
                                    @error('scoreFile') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Paroles (Rich Text) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Paroles</label>
                                <x-rich-text wire:model="lyrics" />
                            </div>

                            <!-- Validation Toggle -->
                            <div class="flex items-center">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="is_approved" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-500"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">Approuver immédiatement</span>
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- FOOTER -->
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3 rounded-b-2xl border-t border-gray-100 dark:border-gray-700 shrink-0">
                    @if($mode === 'show')
                        <button wire:click="edit({{ $currentSong->id }})" class="inline-flex w-full justify-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto">Modifier</button>
                    @else
                        <button wire:click="save" wire:loading.attr="disabled" class="inline-flex w-full justify-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto">
                            <span wire:loading.remove>{{ $mode === 'edit' ? 'Mettre à jour' : 'Enregistrer' }}</span>
                            <span wire:loading>Traitement...</span>
                        </button>
                    @endif
                    <button wire:click="closeModal" class="inline-flex w-full justify-center rounded-lg bg-white dark:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-500 hover:bg-gray-50 dark:hover:bg-gray-500 transition-all sm:w-auto">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>