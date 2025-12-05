<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Catégories</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Classez les publications du diocèse.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-kamina-blue hover:bg-blue-800 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvelle Catégorie
        </button>
    </div>

    <!-- RECHERCHE -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></span>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold focus:border-kamina-gold placeholder-gray-400 transition-colors" placeholder="Rechercher une catégorie...">
        </div>
    </div>

    <!-- TABLEAU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-xs">
                    <tr>
                        <th class="py-4 px-6 font-semibold">Nom</th>
                        <th class="py-4 px-6 font-semibold">Slug</th>
                        <th class="py-4 px-6 text-center font-semibold">Articles liés</th>
                        <th class="py-4 px-6 text-center font-semibold">Date création</th>
                        <th class="py-4 px-6 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <!-- Pastille de couleur -->
                                <span class="w-3 h-3 rounded-full 
                                    {{ $category->color == 'blue' ? 'bg-blue-500' : '' }}
                                    {{ $category->color == 'red' ? 'bg-red-500' : '' }}
                                    {{ $category->color == 'green' ? 'bg-green-500' : '' }}
                                    {{ $category->color == 'yellow' ? 'bg-yellow-500' : '' }}
                                    {{ $category->color == 'purple' ? 'bg-purple-500' : '' }}
                                    {{ $category->color == 'gray' ? 'bg-gray-500' : '' }}
                                    {{ $category->color == 'gold' ? 'bg-yellow-600' : '' }}
                                "></span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-400 font-mono">{{ $category->slug }}</td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                {{ $category->posts_count }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center text-sm text-gray-500">{{ $category->created_at->format('d/m/Y') }}</td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="edit({{ $category->id }})" class="p-2 text-gray-400 hover:text-kamina-gold hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition" title="Editer"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                <button wire:click="delete({{ $category->id }})" wire:confirm="Supprimer cette catégorie ?" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition" title="Supprimer"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-8 text-center text-gray-500">Aucune catégorie trouvée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">{{ $categories->links() }}</div>
    </div>

    <!-- MODALE UNIQUE -->
    @if($isOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:w-full sm:max-w-lg border border-gray-100 dark:border-gray-700">
                
                <div class="bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-kamina-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                        {{ $isEdit ? 'Modifier Catégorie' : 'Nouvelle Catégorie' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>

                <div class="px-6 py-6 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nom de la catégorie</label>
                        <input type="text" wire:model="name" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Couleur du badge</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($colors as $key => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model="color" value="{{ $key }}" class="peer sr-only">
                                    <div class="flex items-center gap-2 px-3 py-2 rounded-lg border dark:border-gray-700 peer-checked:border-kamina-blue peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                        <div class="w-4 h-4 rounded-full 
                                            {{ $key == 'blue' ? 'bg-blue-500' : '' }}
                                            {{ $key == 'green' ? 'bg-green-500' : '' }}
                                            {{ $key == 'red' ? 'bg-red-500' : '' }}
                                            {{ $key == 'yellow' ? 'bg-yellow-500' : '' }}
                                            {{ $key == 'purple' ? 'bg-purple-500' : '' }}
                                            {{ $key == 'gray' ? 'bg-gray-500' : '' }}
                                            {{ $key == 'gold' ? 'bg-yellow-600' : '' }}
                                        "></div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">{{ $label }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('color') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3 rounded-b-2xl border-t border-gray-100 dark:border-gray-700">
                    <button wire:click="save" class="inline-flex w-full justify-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto">
                        {{ $isEdit ? 'Mettre à jour' : 'Créer' }}
                    </button>
                    <button wire:click="closeModal" class="inline-flex w-full justify-center rounded-lg bg-white dark:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-500 hover:bg-gray-50 dark:hover:bg-gray-500 transition-all sm:w-auto">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>