<div class="space-y-6 animate-fadeIn pb-10">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Gestion du Clergé</h2>

    <!-- Onglets -->
    <div class="flex space-x-4 border-b border-gray-200 dark:border-gray-700">
        <button wire:click="$set('tab', 'active')" class="pb-2 px-4 {{ $tab === 'active' ? 'border-b-2 border-kamina-blue text-kamina-blue font-bold' : 'text-gray-500' }}">Prêtres Actifs</button>
        <button wire:click="$set('tab', 'necrology')" class="pb-2 px-4 {{ $tab === 'necrology' ? 'border-b-2 border-kamina-blue text-kamina-blue font-bold' : 'text-gray-500' }}">Nécrologie</button>
    </div>

    <!-- ... (TAB ACTIVE : Code identique à avant) ... -->
    @if($tab === 'active')
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
        <!-- Recherche et Table des prêtres (idem précédent) -->
        <div class="p-4 border-b border-gray-100 dark:border-gray-700">
            <input wire:model.live.debounce.300ms="search" type="text" class="w-full md:w-80 pl-4 pr-4 py-2 rounded-lg border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-kamina-gold" placeholder="Rechercher un prêtre...">
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 font-semibold">Nom</th>
                    <th class="px-6 py-4 font-semibold">Affectation Actuelle</th>
                    <th class="px-6 py-4 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($priests as $priest)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-kamina-blue text-white flex items-center justify-center font-bold">
                                {{ substr($priest->name, 0, 1) }}
                            </div>
                            <div>
                                <span class="font-bold text-gray-900 dark:text-white block">{{ $priest->name }}</span>
                                <span class="text-xs text-gray-500">{{ $priest->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($priest->parish)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                {{ $priest->parish->name }}
                            </span>
                        @else
                            <span class="text-gray-400 italic text-sm">Non affecté</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="openTransferModal({{ $priest->id }})" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-3 py-1 rounded text-sm transition">
                            Muter
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $priests->links() }}</div>
    </div>
    @endif

    <!-- TAB 2 : NÉCROLOGIE -->
    @if($tab === 'necrology')
    <div class="mb-4 text-right">
        <button wire:click="$set('isOpen', true)" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-black transition flex items-center gap-2 ml-auto">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Enregistrer un décès
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($necrologies as $necro)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col group">
                <div class="h-48 bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                    @if($necro->photo_path)
                        <img src="{{ asset('storage/'.$necro->photo_path) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-800">
                            <span class="text-4xl">†</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <p class="text-xs opacity-70 uppercase tracking-widest">{{ $necro->title }}</p>
                        <h3 class="font-bold text-lg">{{ $necro->name }}</h3>
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Rappelé à Dieu le {{ $necro->death_date->format('d/m/Y') }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3 mb-4 prose dark:prose-invert">
                        {!! strip_tags($necro->biography) !!}
                    </div>
                    <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                        <button wire:click="deleteNecrology({{ $necro->id }})" wire:confirm="Attention : Cela ne réactivera pas le compte du prêtre. Continuer ?" class="text-red-500 text-xs hover:text-red-700 font-bold uppercase tracking-wider">
                            Supprimer la fiche
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 text-gray-500">Aucune nécrologie enregistrée.</div>
        @endforelse
    </div>
    @endif

    <!-- ... MODALE MUTATION (Reste inchangée) ... -->

    <!-- MODALE 2 : AJOUT NÉCROLOGIE (Refaite avec Select) -->
    @if($isOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-lg w-full p-8 border border-gray-100 dark:border-gray-700">
                
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-100 pb-4">Enregistrer un décès</h3>
                <p class="text-sm text-gray-500 mb-6 bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                    <span class="font-bold">Attention :</span> Cette action désactivera le compte du prêtre sélectionné et le retirera de son affectation actuelle.
                </p>

                <div class="space-y-5">
                    <!-- Sélection du Prêtre -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Prêtre / Religieux concerné</label>
                        <select wire:model="necroUserId" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                            <option value="">Sélectionner dans la liste...</option>
                            @foreach($allPriests as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->parish->name ?? 'Non affecté' }})</option>
                            @endforeach
                        </select>
                        @error('necroUserId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Date du décès</label>
                        <input type="date" wire:model="necroDate" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                        @error('necroDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Biographie / Hommage</label>
                        <x-rich-text wire:model="necroBio" />
                    </div>

                    <!-- Photo (Optionnelle, sinon prend celle du user si existante) -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Photo (Optionnel)</label>
                        <input type="file" wire:model="necroPhoto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button wire:click="$set('isOpen', false)" class="px-5 py-2.5 text-gray-600 hover:bg-gray-100 rounded-lg font-medium">Annuler</button>
                    <button wire:click="saveNecrology" class="px-5 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-black font-bold shadow-lg">Confirmer le décès</button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>