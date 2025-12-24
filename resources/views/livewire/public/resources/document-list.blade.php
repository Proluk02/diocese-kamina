<div class="bg-brand-light dark:bg-gray-900 min-h-screen py-20 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-kamina-blue dark:text-blue-400 font-bold uppercase tracking-wider text-sm mb-2 block">Ressources</span>
            <h1 class="text-4xl md:text-5xl font-bold font-playfair text-slate-900 dark:text-white mb-4">Médiathèque & Documents</h1>
            <p class="text-lg text-slate-600 dark:text-gray-400 max-w-2xl mx-auto">Retrouvez les homélies, lettres pastorales et communiqués officiels du diocèse.</p>
        </div>

        <!-- Filtres -->
        <div class="sticky top-24 z-40 mb-12 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md p-3 rounded-2xl shadow-sm border border-slate-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 max-w-5xl mx-auto">
            <div class="relative w-full md:w-72">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher un document..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-slate-900 dark:text-white focus:ring-kamina-gold">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>

            <div class="flex flex-wrap justify-center gap-2">
                <button wire:click="filterByType('')" class="px-4 py-2 rounded-lg text-xs font-bold uppercase transition-all {{ $type === '' ? 'bg-kamina-blue text-white' : 'text-slate-500 hover:bg-slate-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">Tout</button>
                @foreach($types as $key => $label)
                    <button wire:click="filterByType('{{ $key }}')" class="px-4 py-2 rounded-lg text-xs font-bold uppercase transition-all {{ $type === $key ? 'bg-kamina-blue text-white' : 'text-slate-500 hover:bg-slate-100 dark:text-gray-400 dark:hover:bg-gray-800' }}">{{ $label }}</button>
                @endforeach
            </div>
        </div>

        <!-- Grille -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($documents as $index => $doc)
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 p-6 border border-slate-100 dark:border-gray-700 flex flex-col relative overflow-hidden">
                    
                    <div class="flex items-start justify-between mb-6">
                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-100 dark:border-gray-700 text-slate-500 dark:text-gray-400 bg-slate-50 dark:bg-gray-900/50">
                            {{ $types[$doc->type] ?? $doc->type }}
                        </span>
                        <span class="text-[11px] text-slate-400 font-bold">{{ $doc->created_at->format('d/m/Y') }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4 line-clamp-2 leading-snug group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors">
                        {{ $doc->title }}
                    </h3>

                    <div class="flex gap-3 mb-8">
                        @if($doc->video_link)
                            <span class="flex items-center gap-1 text-[11px] font-bold text-red-500 bg-red-50 dark:bg-red-900/20 px-2 py-0.5 rounded">VIDÉO</span>
                        @endif
                        @if($doc->file_path)
                            <span class="flex items-center gap-1 text-[11px] font-bold text-blue-500 bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded">PDF</span>
                        @endif
                    </div>

                    <div class="mt-auto flex items-center justify-between pt-5 border-t border-slate-50 dark:border-gray-700/50">
                        <a href="{{ route('documents.public.show', $doc->id) }}" class="text-sm font-black text-kamina-blue dark:text-blue-400 uppercase tracking-tighter flex items-center gap-2 hover:gap-3 transition-all">
                            Voir le détail 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        
                        @if($doc->file_path && $doc->is_downloadable)
                            <button wire:click="download({{ $doc->id }})" wire:loading.attr="disabled" class="p-2.5 rounded-xl bg-slate-50 dark:bg-gray-700 text-slate-400 hover:text-kamina-gold dark:hover:text-yellow-400 transition-all hover:scale-110 shadow-sm" title="Télécharger">
                                <svg wire:loading.remove wire:target="download({{ $doc->id }})" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <!-- Spinner pendant le téléchargement -->
                                <svg wire:loading wire:target="download({{ $doc->id }})" class="animate-spin h-5 w-5" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center bg-white dark:bg-gray-800 rounded-3xl border border-dashed border-slate-200 dark:border-gray-700">
                    <p class="text-slate-500 dark:text-gray-400 font-medium">Aucun document ne correspond à votre recherche.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $documents->links() }}
        </div>
    </div>
</div>