<div class="space-y-8 animate-fadeIn pb-20">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Paramètres Généraux</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gérez l'identité et le contenu statique du site.</p>
        </div>
        <button wire:click="save" wire:loading.attr="disabled" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white bg-kamina-blue hover:bg-blue-800 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
            <span wire:loading.remove class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Enregistrer tout
            </span>
            <span wire:loading>Sauvegarde...</span>
        </button>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- 1. IDENTITÉ & CONTACT -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 space-y-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Identité du Site
            </h3>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nom du Diocèse</label>
                <input type="text" wire:model="site_name" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Email Contact</label>
                    <input type="email" wire:model="contact_email" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                    <input type="text" wire:model="contact_phone" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Adresse Physique</label>
                <textarea wire:model="contact_address" rows="2" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Lien Facebook</label>
                    <input type="url" wire:model="facebook_url" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5" placeholder="https://...">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Lien YouTube</label>
                    <input type="url" wire:model="youtube_url" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5" placeholder="https://...">
                </div>
            </div>
        </div>

        <!-- 2. CARROUSEL ACCUEIL -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 space-y-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Images Carrousel (Accueil)
            </h3>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Ajouter une image</label>
                <div class="flex items-center gap-3">
                    <label class="flex-1 cursor-pointer bg-gray-50 dark:bg-gray-700 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-2 text-center hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <span class="text-sm text-gray-500 dark:text-gray-400" wire:loading.remove wire:target="newSlide">Cliquez pour choisir un fichier</span>
                        <span class="text-sm text-kamina-blue animate-pulse" wire:loading wire:target="newSlide">Chargement...</span>
                        <input type="file" wire:model="newSlide" class="hidden" accept="image/*">
                    </label>
                    <button wire:click="addSlide" wire:loading.attr="disabled" class="px-4 py-2 bg-kamina-gold text-white rounded-lg hover:bg-yellow-600 transition disabled:opacity-50 font-bold text-sm">
                        Ajouter
                    </button>
                </div>
                @error('newSlide') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Liste des images -->
            <div class="grid grid-cols-3 gap-3 max-h-64 overflow-y-auto custom-scrollbar p-1">
                @forelse($slides as $index => $slide)
                    <div class="relative group rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 shadow-sm aspect-video">
                        <img src="{{ str_contains($slide, 'default') ? $slide : asset('storage/'.$slide) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button wire:click="removeSlide({{ $index }})" class="bg-red-600 text-white p-1.5 rounded-full hover:bg-red-700 transition transform hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-xs italic col-span-3 text-center py-4 bg-gray-50 dark:bg-gray-900 rounded-lg">Aucune image. Le site utilisera les images par défaut.</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- 3. PRÉSENTATION & CONTENU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 space-y-8 mt-8">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-kamina-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Contenu de la page "Qui sommes-nous"
        </h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Histoire -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Histoire du Diocèse</label>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                    <x-rich-text wire:model="history_text" />
                </div>
            </div>

            <!-- Mission -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Mission & Vision</label>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                    <x-rich-text wire:model="mission_text" />
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
            <h4 class="text-md font-bold text-gray-700 dark:text-gray-300 mb-6 uppercase tracking-wider text-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Informations sur l'Évêque
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Zone Photo (NOUVEAU) -->
                <div class="col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Photo Officielle</label>
                    
                    <div class="flex flex-col items-center gap-4 p-4 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="relative group">
                            @if ($bishop_photo)
                                <img src="{{ $bishop_photo->temporaryUrl() }}" class="h-32 w-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-md">
                            @elseif ($old_bishop_photo)
                                <img src="{{ asset('storage/'.$old_bishop_photo) }}" class="h-32 w-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-md">
                            @else
                                <div class="h-32 w-32 rounded-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                            
                            <!-- Loading indicator -->
                            <div wire:loading wire:target="bishop_photo" class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center">
                                <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </div>
                        </div>

                        <label class="cursor-pointer px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                            Changer la photo
                            <input type="file" wire:model="bishop_photo" class="hidden" accept="image/*">
                        </label>
                    </div>
                </div>

                <!-- Textes -->
                <div class="col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nom de l'Évêque</label>
                        <input type="text" wire:model="bishop_name" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Biographie courte</label>
                        <!-- Utilisation de Rich Text ici aussi pour le formatage -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <x-rich-text wire:model="bishop_bio" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>