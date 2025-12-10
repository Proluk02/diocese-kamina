<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Page -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold font-playfair text-kamina-blue mb-4">Actualités & Vie du Diocèse</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Suivez les événements, les homélies et les communiqués officiels.</p>
        </div>

        <!-- Filtres Catégories -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <!-- Bouton Tout voir -->
            <button wire:click="$set('category', '')" 
                    class="px-5 py-2 rounded-full text-sm font-medium transition {{ $category === '' ? 'bg-kamina-blue text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                Tout voir
            </button>
            
            <!-- Boutons par catégorie -->
            @foreach($categories as $cat)
                <button wire:click="$set('category', {{ $cat->id }})" 
                        class="px-5 py-2 rounded-full text-sm font-medium transition {{ $category == $cat->id ? 'bg-kamina-blue text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <!-- Grille Articles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($posts as $post)
                {{-- CORRECTION ICI : Utilisation de 'public.news.show' --}}
                <a href="{{ route('news.show', $post->slug) }}" class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full">
                    
                    <!-- Image -->
                    <div class="h-56 overflow-hidden relative shrink-0">
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-kamina-gold text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            {{ $post->category->name }}
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-kamina-blue transition line-clamp-2">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-1">
                            {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 100) }}
                        </p>
                        <span class="text-kamina-blue font-semibold text-sm flex items-center gap-1 group-hover:underline">
                            Lire la suite <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-20">
                    <div class="inline-block p-4 bg-white rounded-full shadow-sm mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <p class="text-gray-500 text-lg">Aucun article trouvé dans cette catégorie.</p>
                    <button wire:click="$set('category', '')" class="mt-4 text-kamina-blue font-medium hover:underline">Voir tous les articles</button>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>