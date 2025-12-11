<div class="bg-gradient-to-b from-brand-light to-white dark:from-gray-900 dark:to-gray-800 min-h-screen py-20 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Page - Redesign -->
        <div class="relative mb-20 overflow-hidden" data-aos="fade-up">
            <!-- Éléments décoratifs -->
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-gradient-to-br from-kamina-blue/10 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-gradient-to-br from-kamina-gold/10 to-transparent rounded-full blur-3xl"></div>
            
            <div class="relative text-center z-10">
                <div class="inline-flex items-center gap-2 text-kamina-gold text-sm font-bold uppercase tracking-widest mb-6">
                    <div class="h-px w-8 bg-kamina-gold"></div>
                    Actualités
                    <div class="h-px w-8 bg-kamina-gold"></div>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold font-playfair text-gray-900 dark:text-white mb-6 leading-tight">
                    Vie du <span class="text-transparent bg-clip-text bg-gradient-to-r from-kamina-blue to-blue-600">Diocèse</span>
                </h1>
                
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                    Suivez les événements, les homélies et les communiqués officiels pour rester connecté à notre communauté.
                </p>
                
                <!-- Stats en ligne -->
                <div class="flex flex-wrap justify-center gap-8 mt-10">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-kamina-blue dark:text-blue-400">{{ $posts->total() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider">Articles</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-kamina-gold">{{ $categories->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider">Catégories</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres Catégories - Design Amélioré -->
        <div class="sticky top-24 z-40 mb-16 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm py-4 rounded-2xl -mx-4 px-4" data-aos="fade-up" data-aos-delay="100">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 flex items-center gap-2">
                    <svg class="w-5 h-5 text-kamina-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filtrer par catégorie
                </span>
                
                <div class="flex flex-wrap justify-center gap-2">
                    <button wire:click="$set('category', '')" 
                            class="group px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 {{ $category === '' 
                                ? 'bg-gradient-to-r from-kamina-blue to-blue-600 text-white shadow-lg shadow-blue-500/30 ring-2 ring-blue-200 dark:ring-blue-800' 
                                : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-800' }}">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            Tout voir
                        </span>
                    </button>
                    
                    @foreach($categories as $cat)
                        <button wire:click="filterByCategory('{{ $cat->slug }}')" 
                                class="group px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 {{ $category === $cat->slug 
                                    ? 'bg-gradient-to-r from-kamina-blue to-blue-600 text-white shadow-lg shadow-blue-500/30 ring-2 ring-blue-200 dark:ring-blue-800' 
                                    : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:text-kamina-blue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-800' }}">
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Grille Articles - Design Magazine -->
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
                @foreach($posts as $index => $post)
                    <article class="group relative flex flex-col h-full bg-white dark:bg-gray-800 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 dark:border-gray-700 transform hover:-translate-y-2"
                             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-kamina-blue/5 dark:to-blue-900/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl"></div>
                        
                        <!-- Image avec effet -->
                        <div class="h-64 overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/30 to-transparent z-10"></div>
                            
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Badge Catégorie -->
                            <div class="absolute top-4 left-4 z-20">
                                <span class="bg-white/95 dark:bg-gray-900/95 backdrop-blur text-kamina-blue dark:text-blue-300 text-xs font-bold px-4 py-2 rounded-full shadow-lg border border-white/20 group-hover:scale-105 transition-transform duration-300">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-8 flex-1 flex flex-col relative z-20">
                            <!-- Métadonnées -->
                            <div class="flex items-center gap-4 text-xs font-medium text-gray-500 dark:text-gray-400 mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $post->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-1 w-1 rounded-full bg-gray-300"></div>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>{{ $post->user->name }}</span>
                                </div>
                            </div>
                            
                            <!-- Titre -->
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors leading-tight">
                                <a href="{{ route('news.show', $post->slug) }}" class="focus:outline-none relative">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            <!-- Extrait -->
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 120) }}
                            </p>
                            
                            <!-- Footer de l'article -->
                            <div class="pt-6 border-t border-gray-100 dark:border-gray-700 mt-auto">
                                <a href="{{ route('news.show', $post->slug) }}" 
                                   class="group/btn inline-flex items-center justify-between w-full text-kamina-blue dark:text-blue-400 font-semibold hover:text-kamina-gold dark:hover:text-yellow-400 transition-colors">
                                    <span class="text-sm">Lire l'article complet</span>
                                    <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Effet de bordure au hover -->
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-kamina-blue/20 dark:group-hover:border-blue-900/30 rounded-3xl transition-colors duration-500 pointer-events-none"></div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- État vide - Design amélioré -->
            <div class="text-center py-32" data-aos="fade-up">
                <div class="relative inline-block mb-8">
                    <div class="absolute inset-0 bg-gradient-to-r from-kamina-blue/20 to-kamina-gold/20 blur-2xl rounded-full"></div>
                    <div class="relative bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                        <svg class="w-20 h-20 text-gray-300 dark:text-gray-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-3">Aucun article trouvé</h3>
                        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto mb-6">
                            {{ $category ? "Aucun article dans la catégorie sélectionnée." : "Aucun article n'a été publié pour le moment." }}
                        </p>
                        <button wire:click="$set('category', '')" 
                                class="px-8 py-3 bg-gradient-to-r from-kamina-blue to-blue-600 text-white font-semibold rounded-full hover:shadow-lg transition-all hover:-translate-y-1">
                            Voir tous les articles
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pagination - Design amélioré -->
        @if($posts->hasPages())
            <div class="mt-20" data-aos="fade-up">
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-4 border border-gray-100 dark:border-gray-700">
                    {{ $posts->links() }}
                </div>
            </div>
        @endif
    </div>
</div>