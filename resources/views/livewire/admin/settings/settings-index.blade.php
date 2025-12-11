<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Paramètres Généraux</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Configuration des informations du site public.</p>
        </div>
        <button wire:click="save" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-kamina-blue hover:bg-blue-800 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Enregistrer les modifications
        </button>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Identité -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 space-y-5">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3">Identité du Site</h3>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nom du Site / Diocèse</label>
                <input type="text" wire:model="site_name" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Adresse Physique</label>
                <textarea wire:model="contact_address" rows="3" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5"></textarea>
            </div>
        </div>

        <!-- Contact & Réseaux -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 space-y-5">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3">Contact & Réseaux Sociaux</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Email Officiel</label>
                    <input type="email" wire:model="contact_email" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                    <input type="text" wire:model="contact_phone" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Lien Page Facebook</label>
                <input type="url" wire:model="facebook_url" placeholder="https://facebook.com/..." class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Lien Chaîne YouTube</label>
                <input type="url" wire:model="youtube_url" placeholder="https://youtube.com/..." class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
            </div>
        </div>

        <!-- SECTION CARROUSEL -->
        <div class="col-span-1 lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">
                Images du Carrousel (Page d'accueil)
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Zone d'ajout -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Ajouter une nouvelle image</label>
                    <div class="flex items-center gap-4">
                        <input type="file" wire:model="newSlide" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                        <button wire:click="addSlide" wire:loading.attr="disabled" class="px-4 py-2 bg-kamina-gold text-white rounded-lg hover:bg-yellow-600 transition disabled:opacity-50">
                            <span wire:loading.remove>Ajouter</span>
                            <span wire:loading>...</span>
                        </button>
                    </div>
                    @error('newSlide') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Liste des images (Preview) -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @forelse($slides as $index => $slide)
                        <div class="relative group rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 shadow-sm">
                            <img src="{{ asset('storage/'.$slide) }}" class="w-full h-24 object-cover">
                            <button wire:click="removeSlide({{ $index }})" class="absolute top-1 right-1 bg-red-600 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm italic col-span-3">Aucune image. Une image par défaut sera affichée.</p>
                    @endforelse
                </div>
            </div>
        </div>

    <!-- ... suite du code ... -->

    </div>
</div>