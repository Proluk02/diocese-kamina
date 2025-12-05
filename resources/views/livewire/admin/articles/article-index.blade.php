<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Gestion des Articles</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Administration du contenu éditorial.</p>
        </div>
        
        <button wire:click="create" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-kamina-blue hover:bg-blue-800 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvel Article
        </button>
    </div>

    <!-- FILTRES -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row gap-4">
        <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></span>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold focus:border-kamina-gold placeholder-gray-400 transition-colors" placeholder="Rechercher un article...">
        </div>
        <select wire:model.live="filterStatus" class="block w-full md:w-48 py-2.5 border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-kamina-gold focus:border-kamina-gold transition-colors">
            <option value="">Tous les statuts</option>
            <option value="published">Publié</option>
            <option value="pending">En attente</option>
            <option value="draft">Brouillon</option>
        </select>
    </div>

    <!-- TABLEAU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-xs">
                    <tr>
                        <th class="py-4 px-6 font-semibold">Article</th>
                        <th class="py-4 px-6 font-semibold">Statut</th>
                        <th class="py-4 px-6 text-center font-semibold">Date</th>
                        <th class="py-4 px-6 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($posts as $post)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 flex-shrink-0 rounded-lg bg-gray-100 dark:bg-gray-700 overflow-hidden border border-gray-200 dark:border-gray-600 relative group">
                                    @if($post->image_path)
                                        <img src="{{ asset('storage/' . $post->image_path) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ Str::limit($post->title, 40) }}</div>
                                    <div class="text-xs text-gray-500">{{ $post->category->name ?? 'Aucune' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border
                                {{ $post->status === 'published' ? 'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800' : 
                                  ($post->status === 'pending' ? 'bg-yellow-100 text-yellow-700 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400 dark:border-yellow-800 animate-pulse' : 
                                  'bg-gray-100 text-gray-600 border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600') }}">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $post->status === 'published' ? 'bg-green-500' : ($post->status === 'pending' ? 'bg-yellow-500' : 'bg-gray-500') }}"></span>
                                {{ match($post->status) { 'published' => 'Publié', 'pending' => 'En attente', default => 'Brouillon' } }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center text-sm text-gray-500">{{ $post->created_at->format('d/m/Y') }}</td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="show({{ $post->id }})" class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition" title="Voir"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg></button>
                                <button wire:click="edit({{ $post->id }})" class="p-2 text-gray-400 hover:text-kamina-gold hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition" title="Editer"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                <button wire:click="delete({{ $post->id }})" wire:confirm="Supprimer cet article ?" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition" title="Supprimer"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-full mb-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                </div>
                                <span class="text-sm font-medium">Aucun article trouvé.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">{{ $posts->links() }}</div>
    </div>

    <!-- ============================================== -->
    <!-- 3. MODALE UNIQUE AVEC EDITEUR RICHE -->
    <!-- ============================================== -->
    @if($isOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop flouté -->
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:w-full sm:max-w-3xl border border-gray-100 dark:border-gray-700 flex flex-col max-h-[90vh]">
                
                <!-- Header Modale -->
                <div class="bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center shrink-0">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        @if($mode === 'show') 
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Détails de l'article
                        @elseif($mode === 'edit') 
                            <svg class="w-5 h-5 text-kamina-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            Modifier l'article
                        @else 
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Créer un article
                        @endif
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Corps Modale (Scrollable) -->
                <div class="px-6 py-6 overflow-y-auto custom-scrollbar">
                    
                    <!-- ================= MODE SHOW ================= -->
                    @if($mode === 'show' && $currentPost)
                        <!-- Image -->
                        @if($currentPost->image_path)
                            <div class="w-full h-64 rounded-xl overflow-hidden mb-6 shadow-md border border-gray-100 dark:border-gray-700">
                                <img src="{{ asset('storage/' . $currentPost->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <!-- Infos -->
                        <div class="flex flex-wrap items-center gap-2 mb-5">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-kamina-blue text-white shadow-sm">
                                {{ $currentPost->category->name }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                Par {{ $currentPost->user->name }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $currentPost->status === 'published' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-yellow-50 text-yellow-700 border-yellow-200' }}">
                                {{ ucfirst($currentPost->status) }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold text-gray-500 bg-gray-50 dark:bg-gray-700/50">
                                {{ $currentPost->created_at->format('d F Y') }}
                            </span>
                        </div>

                        <!-- Contenu Riche (HTML) -->
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">{{ $currentPost->title }}</h2>
                        
                        <!-- ICI: Affichage sécurisé du contenu HTML de Quill -->
                        <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-lg ql-editor px-0">
                            {!! $currentPost->body !!}
                        </div>

                    <!-- ================= MODE CREATE / EDIT ================= -->
                    @else
                        <div class="space-y-6">
                            <!-- Titre -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Titre de l'article</label>
                                <input type="text" wire:model="title" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold transition-colors p-2.5" placeholder="Ex: Célébration de Pâques à la cathédrale...">
                                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <!-- Catégorie -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Catégorie</label>
                                    <select wire:model="category_id" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold transition-colors p-2.5">
                                        <option value="">Sélectionner...</option>
                                        @foreach($categories as $cat) <option value="{{ $cat->id }}">{{ $cat->name }}</option> @endforeach
                                    </select>
                                    @error('category_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <!-- Statut -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Statut</label>
                                    <select wire:model="status" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold transition-colors p-2.5">
                                        <option value="draft">Brouillon</option>
                                        <option value="pending">En attente</option>
                                        <option value="published">Publié</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Upload Image -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl border border-dashed border-gray-300 dark:border-gray-600">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Image de couverture</label>
                                <div class="flex items-center gap-5">
                                    <div class="relative group">
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" class="h-24 w-24 rounded-lg object-cover border-2 border-white dark:border-gray-600 shadow-sm">
                                        @elseif ($existingImage)
                                            <img src="{{ asset('storage/'.$existingImage) }}" class="h-24 w-24 rounded-lg object-cover border-2 border-white dark:border-gray-600 shadow-sm">
                                        @else
                                            <div class="h-24 w-24 rounded-lg bg-white dark:bg-gray-800 flex items-center justify-center text-gray-400 border border-gray-200 dark:border-gray-600 shadow-inner">
                                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                        @endif
                                        <div wire:loading wire:target="image" class="absolute inset-0 bg-white/80 dark:bg-gray-900/80 flex items-center justify-center rounded-lg">
                                            <svg class="animate-spin h-6 w-6 text-kamina-blue" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <label class="cursor-pointer inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                            Choisir un fichier...
                                            <input type="file" wire:model="image" class="hidden" accept="image/*">
                                        </label>
                                        <p class="text-xs text-gray-500 mt-2">PNG, JPG, WEBP jusqu'à 5MB.</p>
                                    </div>
                                </div>
                                @error('image') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Contenu (Éditeur Riche) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Contenu</label>
                                
                                <!-- Utilisation du composant Rich Text -->
                                <x-rich-text wire:model="body" />
                                
                                @error('body') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Footer Modale -->
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3 rounded-b-2xl shrink-0 border-t border-gray-100 dark:border-gray-700">
                    @if($mode === 'show')
                        <button wire:click="edit({{ $currentPost->id }})" class="inline-flex w-full justify-center items-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto">
                            Modifier l'article
                        </button>
                    @else
                        <button wire:click="save" wire:loading.attr="disabled" class="inline-flex w-full justify-center items-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>{{ $mode === 'edit' ? 'Mettre à jour' : 'Enregistrer' }}</span>
                            <span wire:loading>Traitement...</span>
                        </button>
                    @endif
                    <button wire:click="closeModal" class="inline-flex w-full justify-center items-center rounded-lg bg-white dark:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-500 hover:bg-gray-50 dark:hover:bg-gray-500 transition-all sm:w-auto">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>