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

    <!-- BARRE DE FILTRES COMPLÈTE -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 grid grid-cols-1 md:grid-cols-4 gap-4">
        
        <!-- Recherche -->
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></span>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold focus:border-kamina-gold transition-colors" placeholder="Rechercher...">
        </div>

        <!-- Statut -->
        <select wire:model.live="filterStatus" class="block w-full py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold">
            <option value="">Tous les statuts</option>
            <option value="approved">Validés</option>
            <option value="pending">En attente</option>
        </select>

        <!-- Saison (Réintégré) -->
        <select wire:model.live="filterSeason" class="block w-full py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold">
            <option value="">Toutes saisons</option>
            @foreach($seasons as $s) <option value="{{ $s }}">{{ $s }}</option> @endforeach
        </select>

        <!-- Thème (Réintégré) -->
        <select wire:model.live="filterTheme" class="block w-full py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold">
            <option value="">Tous les thèmes</option>
            @foreach($themes as $t) <option value="{{ $t }}">{{ $t }}</option> @endforeach
        </select>
    </div>

    <!-- TABLEAU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-4">Titre</th>
                        <th class="px-6 py-4">Moment</th>
                        <th class="px-6 py-4">Saison</th>
                        <th class="px-6 py-4 text-center">Statut</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($songs as $song)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900 dark:text-white">{{ $song->title }}</div>
                            <div class="text-xs text-gray-500">{{ $song->composer ?? 'Inconnu' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $song->liturgical_moment }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $song->liturgical_season ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($song->is_approved)
                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Publié</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full animate-pulse">En attente</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                            <button wire:click="show({{ $song->id }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded">Voir</button>
                            <button wire:click="edit({{ $song->id }})" class="p-2 text-kamina-gold hover:bg-yellow-50 rounded">Edit</button>
                            <button wire:click="delete({{ $song->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer ce chant ?" class="p-2 text-red-500 hover:bg-red-50 rounded">Suppr</button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-8 text-center text-gray-500">Aucun chant.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">{{ $songs->links() }}</div>
    </div>

    <!-- MODALE UNIQUE -->
    @if($isOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-2xl border border-gray-100 dark:border-gray-700 flex flex-col max-h-[90vh]">
                
                <!-- HEADER -->
                <div class="bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center shrink-0 rounded-t-2xl">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $mode === 'show' ? 'Détails' : ($mode === 'edit' ? 'Modifier Chant' : 'Nouveau Chant') }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 p-2"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>

                <!-- CORPS (SCROLL) -->
                <div class="px-6 py-6 overflow-y-auto custom-scrollbar">
                    
                    @if($mode === 'show' && $currentSong)
                        <!-- VUE DÉTAIL -->
                        <div class="space-y-6 text-center">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $currentSong->title }}</h2>
                            <p class="text-kamina-gold">{{ $currentSong->composer }}</p>
                            
                            <div class="flex justify-center gap-2">
                                <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded">{{ $currentSong->liturgical_moment }}</span>
                                @if($currentSong->liturgical_season) <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded">{{ $currentSong->liturgical_season }}</span> @endif
                            </div>

                            @if($currentSong->audio_path)
                                <audio controls class="w-full mt-4"><source src="{{ asset('storage/'.$currentSong->audio_path) }}" type="audio/mpeg"></audio>
                            @endif

                            @if($currentSong->lyrics)
                                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded text-left prose dark:prose-invert max-w-none">{!! $currentSong->lyrics !!}</div>
                            @endif

                            @if($currentSong->score_path)
                                <a href="{{ asset('storage/'.$currentSong->score_path) }}" target="_blank" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Voir la Partition</a>
                            @endif
                        </div>

                    @else
                        <!-- FORMULAIRE (CREATE/EDIT) -->
                        <div class="space-y-5">
                            <!-- Titre & Compositeur -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Titre</label>
                                    <input type="text" wire:model="title" class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white p-2.5">
                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Compositeur</label>
                                    <input type="text" wire:model="composer" class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white p-2.5">
                                </div>
                            </div>

                            <!-- Catégorisation Complète -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Moment</label>
                                    <select wire:model="liturgical_moment" class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white p-2.5">
                                        <option value="">Choisir...</option>
                                        @foreach($moments as $m) <option value="{{ $m }}">{{ $m }}</option> @endforeach
                                    </select>
                                    @error('liturgical_moment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Saison</label>
                                    <select wire:model="liturgical_season" class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white p-2.5">
                                        <option value="">Toutes</option>
                                        @foreach($seasons as $s) <option value="{{ $s }}">{{ $s }}</option> @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Thème</label>
                                    <select wire:model="theme" class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white p-2.5">
                                        <option value="">Aucun</option>
                                        @foreach($themes as $t) <option value="{{ $t }}">{{ $t }}</option> @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Fichiers -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded border-dashed border-2 border-blue-200">
                                    <label class="block text-xs font-bold text-blue-800 dark:text-blue-300 mb-1">Audio (MP3)</label>
                                    <input type="file" wire:model="audioFile" class="text-xs text-gray-500">
                                </div>
                                <div class="bg-red-50 dark:bg-red-900/20 p-3 rounded border-dashed border-2 border-red-200">
                                    <label class="block text-xs font-bold text-red-800 dark:text-red-300 mb-1">Partition (PDF)</label>
                                    <input type="file" wire:model="scoreFile" class="text-xs text-gray-500">
                                </div>
                            </div>

                            <!-- Paroles (Rich Text) -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Paroles</label>
                                <x-rich-text wire:model="lyrics" />
                            </div>

                            <!-- Bio Compositeur -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Note Compositeur</label>
                                <textarea wire:model="composer_description" rows="2" class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white p-2.5"></textarea>
                            </div>

                            <!-- Validation -->
                            @if(auth()->user()->isAdmin())
                                <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <input type="checkbox" wire:model="is_approved" class="w-5 h-5 text-green-600 rounded">
                                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-200">Publier immédiatement</span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- FOOTER -->
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3 rounded-b-2xl border-t border-gray-100 dark:border-gray-700 shrink-0">
                    @if($mode === 'show')
                        <button wire:click="edit({{ $currentSong->id }})" class="px-4 py-2 bg-kamina-blue text-white rounded hover:bg-blue-800">Modifier</button>
                    @else
                        <button wire:click="save" 
                                wire:loading.attr="disabled"
                                class="px-4 py-2 bg-kamina-blue text-white rounded hover:bg-blue-800 flex items-center gap-2 disabled:opacity-50">
                            <span wire:loading.remove>Enregistrer</span>
                            <span wire:loading>Traitement...</span>
                        </button>
                    @endif
                    <button wire:click="closeModal" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>