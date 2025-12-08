<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Gestion des Paroisses</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gérez les lieux de culte, coordonnées et horaires.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-kamina-blue hover:bg-blue-800 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvelle Paroisse
        </button>
    </div>

    <!-- RECHERCHE -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></span>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold focus:border-kamina-gold transition-colors" placeholder="Rechercher une paroisse...">
        </div>
    </div>

    <!-- TABLEAU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-xs">
                    <tr>
                        <th class="py-4 px-6 font-semibold">Paroisse</th>
                        <th class="py-4 px-6 font-semibold">Ville</th>
                        <th class="py-4 px-6 text-center font-semibold">Coordonnées</th>
                        <th class="py-4 px-6 text-center font-semibold">Contact</th>
                        <th class="py-4 px-6 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($parishes as $parish)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 flex-shrink-0 rounded-lg bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                    @if($parish->photo_path)
                                        <img src="{{ asset('storage/'.$parish->photo_path) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-400"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ $parish->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Str::limit($parish->address, 30) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-gray-700 dark:text-gray-300">{{ $parish->city }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($parish->latitude && $parish->longitude)
                                <span class="text-xs bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 px-2 py-1 rounded cursor-help" title="{{ $parish->latitude }}, {{ $parish->longitude }}">
                                    GPS OK
                                </span>
                            @else
                                <span class="text-xs bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 px-2 py-1 rounded">
                                    Manquant
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center text-sm text-gray-500">{{ $parish->contact_phone ?? '-' }}</td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="show({{ $parish->id }})" class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg></button>
                                <button wire:click="edit({{ $parish->id }})" class="p-2 text-gray-400 hover:text-kamina-gold hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                <button wire:click="delete({{ $parish->id }})" wire:confirm="Supprimer cette paroisse ?" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-8 text-center text-gray-500">Aucune paroisse trouvée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">{{ $parishes->links() }}</div>
    </div>

    <!-- MODALE UNIQUE -->
    @if($isOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:w-full sm:max-w-3xl border border-gray-100 dark:border-gray-700 flex flex-col max-h-[90vh]">
                
                <!-- HEADER -->
                <div class="bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center shrink-0">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-kamina-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        {{ $mode === 'show' ? 'Détails Paroisse' : ($mode === 'edit' ? 'Modifier Paroisse' : 'Nouvelle Paroisse') }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>

                <!-- CORPS -->
                <div class="px-6 py-6 overflow-y-auto custom-scrollbar">
                    
                    @if($mode === 'show' && $currentParish)
                        <div class="space-y-6">
                            @if($currentParish->photo_path)
                                <img src="{{ asset('storage/'.$currentParish->photo_path) }}" class="w-full h-64 object-cover rounded-xl shadow-md">
                            @endif
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $currentParish->name }}</h2>
                                    <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg> {{ $currentParish->address }}, {{ $currentParish->city }}</p>
                                    
                                    @if($currentParish->latitude && $currentParish->longitude)
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $currentParish->latitude }},{{ $currentParish->longitude }}" target="_blank" class="text-sm text-kamina-blue hover:underline flex items-center gap-1 mt-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                                            Voir sur la carte
                                        </a>
                                    @endif

                                    <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-3"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> {{ $currentParish->contact_phone }}</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-xl border border-gray-100 dark:border-gray-700">
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Horaires des Messes
                                    </h4>
                                    <div class="prose dark:prose-invert text-sm ql-editor px-0">{!! $currentParish->mass_schedules !!}</div>
                                </div>
                            </div>

                            @if($currentParish->history)
                                <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Histoire / Description</h4>
                                    <div class="prose dark:prose-invert ql-editor px-0">{!! $currentParish->history !!}</div>
                                </div>
                            @endif
                        </div>

                    @else
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nom de la Paroisse</label>
                                    <input type="text" wire:model="name" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Ville</label>
                                    <input type="text" wire:model="city" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                                    @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Adresse</label>
                                    <input type="text" wire:model="address" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Téléphone Contact</label>
                                    <input type="text" wire:model="contact_phone" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                                </div>
                            </div>

                            <!-- COORDONNÉES GPS -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl border border-gray-200 dark:border-gray-700">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Localisation GPS</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Latitude</label>
                                        <input type="text" wire:model="latitude" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm p-2.5" placeholder="Ex: -8.7364">
                                        @error('latitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Longitude</label>
                                        <input type="text" wire:model="longitude" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm p-2.5" placeholder="Ex: 24.9987">
                                        @error('longitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400 mt-2">Vous pouvez trouver ces coordonnées sur Google Maps (Clic droit > Plus d'infos).</p>
                            </div>

                            <!-- Photo -->
                            <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg border border-dashed border-gray-300 dark:border-gray-600">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Photo de l'église</label>
                                <div class="flex items-center gap-4">
                                    @if ($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" class="h-20 w-20 rounded object-cover">
                                    @elseif ($oldPhoto)
                                        <img src="{{ asset('storage/'.$oldPhoto) }}" class="h-20 w-20 rounded object-cover">
                                    @endif
                                    <input type="file" wire:model="photo" class="text-sm">
                                </div>
                                @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Rich Text: Horaires -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Horaires des Messes</label>
                                <x-rich-text wire:model="mass_schedules" />
                            </div>

                            <!-- Rich Text: Histoire -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Histoire / Description</label>
                                <x-rich-text wire:model="history" />
                            </div>
                        </div>
                    @endif
                </div>

                <!-- FOOTER -->
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3 rounded-b-2xl border-t border-gray-100 dark:border-gray-700 shrink-0">
                    @if($mode === 'show')
                        <button wire:click="edit({{ $currentParish->id }})" class="inline-flex w-full justify-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto">Modifier</button>
                    @else
                        <button wire:click="save" wire:loading.attr="disabled" class="inline-flex w-full justify-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto">
                            <span wire:loading.remove>{{ $mode === 'edit' ? 'Mettre à jour' : 'Enregistrer' }}</span>
                            <span wire:loading>...</span>
                        </button>
                    @endif
                    <button wire:click="closeModal" class="inline-flex w-full justify-center rounded-lg bg-white dark:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-500 hover:bg-gray-50 dark:hover:bg-gray-500 transition-all sm:w-auto">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>