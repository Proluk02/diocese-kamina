<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Gestion du Clergé</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gérez les affectations pastorales et la mémoire des défunts.</p>
        </div>
        
        <!-- Boutons d'action conditionnels -->
        @if($tab === 'necrology')
            <button wire:click="$set('isOpen', true); $set('mode', 'create')" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajouter un décès
            </button>
        @endif
    </div>

    <!-- ONGLETS -->
    <div class="flex space-x-1 bg-gray-100 dark:bg-gray-700 p-1 rounded-xl w-fit">
        <button wire:click="$set('tab', 'active')" 
                class="px-6 py-2.5 text-sm font-bold rounded-lg transition-all {{ $tab === 'active' ? 'bg-white dark:bg-gray-800 text-kamina-blue shadow-sm' : 'text-gray-500 dark:text-gray-300 hover:text-gray-700' }}">
            Prêtres Actifs
        </button>
        <button wire:click="$set('tab', 'necrology')" 
                class="px-6 py-2.5 text-sm font-bold rounded-lg transition-all {{ $tab === 'necrology' ? 'bg-white dark:bg-gray-800 text-kamina-blue shadow-sm' : 'text-gray-500 dark:text-gray-300 hover:text-gray-700' }}">
            Nécrologie
        </button>
    </div>

    <!-- ============================================== -->
    <!-- TAB 1 : PRÊTRES ACTIFS (MUTATIONS) -->
    <!-- ============================================== -->
    @if($tab === 'active')
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
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
                @forelse($priests as $priest)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-kamina-blue text-white flex items-center justify-center font-bold">
                                {{ substr($priest->name, 0, 1) }}
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $priest->name }}</span>
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
                        <button wire:click="openTransferModal({{ $priest->id }})" class="text-sm font-medium text-kamina-gold hover:underline">
                            Muter / Affecter
                        </button>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="3" class="p-8 text-center text-gray-500">Aucun prêtre trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">{{ $priests->links() }}</div>
    </div>
    @endif

    <!-- ============================================== -->
    <!-- TAB 2 : NÉCROLOGIE -->
    <!-- ============================================== -->
    @if($tab === 'necrology')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($necrologies as $necro)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col">
                <div class="h-48 bg-gray-200 dark:bg-gray-700 relative">
                    @if($necro->photo_path)
                        <img src="{{ asset('storage/'.$necro->photo_path) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-4">
                        <span class="text-white font-bold text-lg">{{ $necro->title }} {{ $necro->name }}</span>
                    </div>
                </div>
                <div class="p-4 flex-1">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                        Décédé le {{ $necro->death_date->format('d/m/Y') }}
                    </p>
                    <div class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3 mb-4">
                        {!! strip_tags($necro->biography) !!}
                    </div>
                    <button wire:click="deleteNecrology({{ $necro->id }})" wire:confirm="Supprimer cette fiche ?" class="text-red-500 text-xs hover:underline">Supprimer</button>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 text-gray-500">Aucune nécrologie enregistrée.</div>
        @endforelse
    </div>
    @endif

    <!-- ============================================== -->
    <!-- MODALE 1 : MUTATION (Transfert) -->
    <!-- ============================================== -->
    @if($isTransferModalOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-lg w-full p-6 border border-gray-100 dark:border-gray-700">
                
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Mutation de {{ $selectedPriest->name }}</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nouvelle Paroisse</label>
                        <select wire:model="new_parish_id" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                            <option value="">Sélectionner...</option>
                            @foreach($parishes as $p) <option value="{{ $p->id }}">{{ $p->name }}</option> @endforeach
                        </select>
                        @error('new_parish_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nouvelle Fonction</label>
                        <select wire:model="new_function" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                            <option value="Curé">Curé</option>
                            <option value="Vicaire">Vicaire</option>
                            <option value="Aumônier">Aumônier</option>
                            <option value="Administrateur">Administrateur Paroissial</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Date d'effet</label>
                        <input type="date" wire:model="transfer_date" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button wire:click="$set('isTransferModalOpen', false)" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Annuler</button>
                    <button wire:click="executeTransfer" class="px-4 py-2 bg-kamina-blue text-white rounded-lg hover:bg-blue-800">Valider la Mutation</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ============================================== -->
    <!-- MODALE 2 : AJOUT NÉCROLOGIE -->
    <!-- ============================================== -->
    @if($isOpen && $tab === 'necrology')
    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full p-6 border border-gray-100 dark:border-gray-700">
                
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Ajouter un décès</h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Titre</label>
                            <select wire:model="necroTitle" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                                <option value="Abbé">Abbé</option>
                                <option value="Monseigneur">Monseigneur</option>
                                <option value="Père">Père</option>
                                <option value="Sœur">Sœur</option>
                                <option value="Frère">Frère</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nom Complet</label>
                            <input type="text" wire:model="necroName" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Date du décès</label>
                        <input type="date" wire:model="necroDate" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-2.5">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Biographie / Hommage</label>
                        <x-rich-text wire:model="necroBio" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Photo</label>
                        <input type="file" wire:model="necroPhoto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button wire:click="$set('isOpen', false)" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Annuler</button>
                    <button wire:click="saveNecrology" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-black">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>