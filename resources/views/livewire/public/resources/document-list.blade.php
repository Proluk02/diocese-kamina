<div class="bg-brand-light dark:bg-gray-900 min-h-screen py-20 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-kamina-blue dark:text-blue-400 font-bold uppercase tracking-wider text-sm mb-2 block">
                Ressources
            </span>
            <h1 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 dark:text-white mb-4">
                Médiathèque & Documents
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Retrouvez les homélies, lettres pastorales et communiqués officiels du diocèse.
            </p>
        </div>

        <!-- Filtres (Sticky) -->
        <div class="sticky top-24 z-40 mb-12 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md p-2 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 max-w-5xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            <!-- Recherche -->
            <div class="relative w-full md:w-72">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-none bg-gray-100/50 dark:bg-gray-800 focus:ring-2 focus:ring-kamina-gold text-sm text-gray-900 dark:text-white placeholder-gray-500">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Boutons Types -->
            <div class="flex flex-wrap justify-center gap-2 p-1">
                <button wire:click="filterByType('')" 
                        class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide transition-all {{ $type === '' ? 'bg-kamina-blue text-white shadow-md' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    Tout
                </button>
                @foreach($types as $key => $label)
                    <button wire:click="filterByType('{{ $key }}')" 
                            class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide transition-all {{ $type === $key ? 'bg-kamina-blue text-white shadow-md' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Grille Documents -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($documents as $index => $doc)
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 dark:border-gray-700 flex flex-col transform hover:-translate-y-1"
                     data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    
                    <div class="flex items-start justify-between mb-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border 
                            {{ $doc->type == 'homelie' ? 'bg-purple-50 text-purple-700 border-purple-100 dark:bg-purple-900/20 dark:text-purple-300 dark:border-purple-800' : '' }}
                            {{ $doc->type == 'lettre' ? 'bg-blue-50 text-blue-700 border-blue-100 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : '' }}
                            {{ $doc->type == 'communique' ? 'bg-orange-50 text-orange-700 border-orange-100 dark:bg-orange-900/20 dark:text-orange-300 dark:border-orange-800' : '' }}
                            {{ $doc->type == 'rapport' ? 'bg-gray-50 text-gray-700 border-gray-100 dark:bg-gray-700/50 dark:text-gray-300 dark:border-gray-600' : '' }}">
                            {{ $types[$doc->type] ?? $doc->type }}
                        </span>
                        <span class="text-xs text-gray-400 font-medium">{{ $doc->created_at->format('d M Y') }}</span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors">
                        <a href="{{ route('documents.public.show', $doc->id) }}" class="focus:outline-none">
                            <span class="absolute inset-0"></span>
                            {{ $doc->title }}
                        </a>
                    </h3>

                    <!-- Indicateurs -->
                    <div class="flex gap-4 mb-6 text-sm">
                        @if($doc->video_link)
                            <span class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 font-medium">
                                <div class="w-2 h-2 rounded-full bg-red-500"></div> Vidéo
                            </span>
                        @endif
                        @if($doc->file_path)
                            <span class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 font-medium">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div> PDF
                            </span>
                        @endif
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-50 dark:border-gray-700/50 flex justify-between items-center">
                        <span class="text-kamina-blue dark:text-blue-400 font-bold text-sm flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            Consulter <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                        
                        @if($doc->file_path && $doc->is_downloadable)
                            <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="text-gray-400 hover:text-kamina-gold dark:hover:text-yellow-500 transition-colors z-10" title="Télécharger direct">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-3 py-20 text-center">
                    <div class="inline-block p-4 rounded-full bg-white dark:bg-gray-800 shadow-sm mb-4 text-gray-300 dark:text-gray-600">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Aucun document trouvé.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $documents->links() }}
        </div>
    </div>
</div>