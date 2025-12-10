<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold font-playfair text-kamina-blue mb-4">Médiathèque & Documents</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Retrouvez les homélies, lettres pastorales et communiqués officiels du diocèse.</p>
        </div>

        <!-- Filtres -->
        <div class="flex flex-col md:flex-row justify-center items-center gap-4 mb-10">
            <!-- Recherche -->
            <div class="relative w-full md:w-64">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:border-kamina-gold focus:ring-kamina-gold text-sm">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Boutons Types -->
            <div class="flex flex-wrap justify-center gap-2">
                <button wire:click="filterByType('')" class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === '' ? 'bg-kamina-blue text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">Tout</button>
                @foreach($types as $key => $label)
                    <button wire:click="filterByType('{{ $key }}')" class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === $key ? 'bg-kamina-blue text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Grille Documents -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($documents as $doc)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 border border-gray-100 flex flex-col">
                    <div class="flex items-start justify-between mb-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                            {{ $doc->type == 'homelie' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $doc->type == 'lettre' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $doc->type == 'communique' ? 'bg-orange-100 text-orange-700' : '' }}
                            {{ $doc->type == 'rapport' ? 'bg-gray-100 text-gray-700' : '' }}">
                            {{ $types[$doc->type] ?? $doc->type }}
                        </span>
                        <span class="text-xs text-gray-400">{{ $doc->created_at->format('d M Y') }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-kamina-blue transition">
                        <a href="{{ route('documents.public.show', $doc->id) }}">{{ $doc->title }}</a>
                    </h3>

                    <!-- Icônes indicateurs -->
                    <div class="flex gap-3 mb-6 text-sm text-gray-500">
                        @if($doc->video_link)
                            <span class="flex items-center gap-1 text-red-500"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg> Vidéo</span>
                        @endif
                        @if($doc->file_path)
                            <span class="flex items-center gap-1 text-blue-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg> PDF</span>
                        @endif
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center">
                        <a href="{{ route('documents.public.show', $doc->id) }}" class="text-kamina-blue font-medium text-sm hover:underline">Lire / Voir</a>
                        
                        @if($doc->file_path && $doc->is_downloadable)
                            <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="text-gray-400 hover:text-kamina-gold" title="Télécharger">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">Aucun document trouvé.</div>
            @endforelse
        </div>

        <div class="mt-8">{{ $documents->links() }}</div>
    </div>
</div>