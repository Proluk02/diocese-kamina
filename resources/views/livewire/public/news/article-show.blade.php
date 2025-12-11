<div class="bg-gradient-to-b from-white to-gray-50/50 dark:from-gray-900 dark:to-gray-800/50 min-h-screen pb-20 transition-colors duration-300">
    
    <!-- Header Immersif avec Parallaxe Amélioré -->
    <div class="relative h-[70vh] min-h-[600px] w-full bg-gray-900 overflow-hidden flex items-center justify-center">
        <!-- Image de fond avec effet parallaxe -->
        <div class="absolute inset-0">
            @if($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" 
                     class="w-full h-full object-cover opacity-70 transform scale-110 animate-scale-in"
                     data-aos="zoom-out"
                     data-aos-duration="1500"
                     alt="{{ $post->title }}">
            @else
                <div class="w-full h-full bg-gradient-to-br from-kamina-blue to-blue-800 flex items-center justify-center">
                    <span class="text-white text-8xl font-bold opacity-10 font-playfair">DK</span>
                </div>
            @endif
            <!-- Overlay gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
            <!-- Texture subtile -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Contenu Header -->
        <div class="relative z-30 max-w-4xl mx-auto px-4 text-center" data-aos="fade-up" data-aos-delay="300">
            <!-- Bouton retour avec animation -->
            <a href="{{ route('news.index') }}" 
               class="group inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 hover:text-white px-5 py-2.5 rounded-full mb-8 transition-all duration-300 hover:bg-white/20 hover:scale-105">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="text-sm font-bold tracking-widest uppercase">Retour aux actualités</span>
            </a>
            
            <!-- Titre principal -->
            <div class="mb-8">
                <span class="inline-block bg-gradient-to-r from-kamina-gold/20 to-yellow-600/20 backdrop-blur border border-kamina-gold/30 text-kamina-gold text-xs font-bold px-4 py-2 rounded-full mb-6 shadow-lg">
                    {{ $post->category->name }}
                </span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white font-playfair leading-tight mb-8 drop-shadow-2xl tracking-tight">
                    {{ $post->title }}
                </h1>
            </div>
            
            <!-- Métadonnées élégantes -->
            <div class="flex flex-wrap items-center justify-center gap-6 text-white/90">
                <!-- Auteur -->
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-white font-bold text-lg">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                    <div class="text-left">
                        <div class="font-bold text-white">{{ $post->user->name }}</div>
                        <div class="text-white/60 text-sm">Auteur</div>
                    </div>
                </div>
                
                <!-- Date -->
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">{{ $post->created_at->translatedFormat('d F Y') }}</span>
                </div>
                
                <!-- Temps de lecture -->
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">5 min de lecture</span>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-8 h-8 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>

    <!-- Contenu Article -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 relative z-30">
        <!-- Carte de contenu flottante -->
        <article class="relative bg-white dark:bg-gray-800 rounded-[2rem] shadow-2xl p-8 md:p-14 border border-gray-100 dark:border-gray-700" 
                 data-aos="fade-up" data-aos-delay="200">
            
            <!-- Décoration d'angle -->
            <div class="absolute top-0 right-0 w-32 h-32 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-kamina-gold/10 to-transparent transform translate-x-16 -translate-y-16 rotate-45"></div>
            </div>
            
            <!-- Navigation de l'article (sticky) -->
            <div class="sticky top-24 mb-10 bg-gray-50 dark:bg-gray-900/50 rounded-2xl p-6 backdrop-blur-sm border border-gray-200 dark:border-gray-700">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-gray-600 dark:text-gray-400">Publié le :</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $post->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Partager :</span>
                        <div class="flex gap-2">
                            <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-all hover:scale-105 shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </button>
                            <button class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition-all hover:scale-105 shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </button>
                            <button class="w-10 h-10 rounded-full bg-gray-700 text-white flex items-center justify-center hover:bg-gray-800 transition-all hover:scale-105 shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Injection du contenu Quill avec style amélioré -->
            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-playfair prose-headings:font-bold 
                       prose-a:text-kamina-blue dark:prose-a:text-blue-400 prose-a:no-underline hover:prose-a:underline
                       prose-img:rounded-2xl prose-img:shadow-xl prose-img:mx-auto prose-img:max-w-full
                       prose-blockquote:border-l-4 prose-blockquote:border-kamina-gold prose-blockquote:pl-6
                       prose-blockquote:bg-gradient-to-r prose-blockquote:from-yellow-50 prose-blockquote:to-transparent
                       dark:prose-blockquote:from-gray-800 dark:prose-blockquote:via-gray-800/50 dark:prose-blockquote:to-transparent
                       prose-blockquote:italic prose-blockquote:py-2 prose-blockquote:pr-4
                       prose-strong:text-gray-900 dark:prose-strong:text-white
                       prose-ul:list-none prose-ul:pl-0
                       prose-li:relative prose-li:pl-6 prose-li:my-2
                       prose-li:before:content-[''] prose-li:before:absolute prose-li:before:left-0 prose-li:before:top-3 
                       prose-li:before:w-2 prose-li:before:h-2 prose-li:before:rounded-full prose-li:before:bg-kamina-blue
                       prose-table:border prose-table:border-gray-200 dark:prose-table:border-gray-700 prose-table:rounded-lg
                       prose-th:bg-gray-50 dark:prose-th:bg-gray-800 prose-th:p-4 prose-th:font-semibold
                       prose-td:p-4 prose-td:border-t prose-td:border-gray-100 dark:prose-td:border-gray-800
                       leading-relaxed text-gray-700 dark:text-gray-300">
                {!! $post->body !!}
            </div>
            
            <!-- Tags et Catégories -->
            <div class="mt-12 pt-10 border-t border-gray-100 dark:border-gray-700">
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <span class="text-sm font-bold text-gray-600 dark:text-gray-400">Catégorie :</span>
                    <a href="{{ route('news.index', ['category' => $post->category->slug]) }}" 
                       class="px-4 py-2 bg-gradient-to-r from-kamina-blue/10 to-blue-600/10 text-kamina-blue dark:text-blue-400 text-sm font-semibold rounded-full border border-blue-200 dark:border-blue-800 hover:from-blue-100 dark:hover:from-blue-900/30 transition-all">
                        {{ $post->category->name }}
                    </a>
                </div>
                
                <!-- Bouton de retour -->
                <div class="text-center mt-12">
                    <a href="{{ route('news.index') }}" 
                       class="group inline-flex items-center gap-3 px-8 py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-full hover:border-kamina-blue hover:text-kamina-blue dark:hover:text-white hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour aux actualités
                    </a>
                </div>
            </div>
        </article>

        <!-- Articles Similaires - Design amélioré -->
        @if($relatedPosts->count() > 0)
        <div class="mt-20" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <div class="inline-flex items-center gap-2 text-kamina-blue dark:text-blue-400 text-sm font-bold uppercase tracking-wider mb-3">
                        <div class="w-6 h-0.5 bg-kamina-blue"></div>
                        Pour aller plus loin
                        <div class="w-6 h-0.5 bg-kamina-blue"></div>
                    </div>
                    <h3 class="text-3xl font-bold font-playfair text-gray-900 dark:text-white">
                        Dans la même <span class="text-transparent bg-clip-text bg-gradient-to-r from-kamina-blue to-blue-600">catégorie</span>
                    </h3>
                </div>
                <a href="{{ route('news.index', ['category' => $post->category->slug]) }}" 
                   class="hidden md:flex items-center gap-2 text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-kamina-blue dark:hover:text-blue-400 transition-colors">
                    Voir tous
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $related)
                    <a href="{{ route('news.show', $related->slug) }}" 
                       class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-700 transform hover:-translate-y-2"
                       data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Image -->
                        <div class="h-48 overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/30 to-transparent z-10"></div>
                            @if($related->image_path)
                                <img src="{{ asset('storage/' . $related->image_path) }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     alt="{{ $related->title }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-3">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $related->created_at->format('d M Y') }}
                            </div>
                            
                            <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200 mb-3 line-clamp-2 group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors leading-tight">
                                {{ $related->title }}
                            </h4>
                            
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $related->category->name }}</span>
                                <span class="text-sm font-semibold text-kamina-blue dark:text-blue-400 group-hover:translate-x-1 transition-transform flex items-center gap-1">
                                    Lire <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Effet de bordure au hover -->
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-kamina-blue/20 dark:group-hover:border-blue-900/30 rounded-2xl transition-colors duration-500 pointer-events-none"></div>
                    </a>
                @endforeach
            </div>
            
            <!-- Bouton mobile -->
            <div class="text-center mt-10 md:hidden">
                <a href="{{ route('news.index', ['category' => $post->category->slug]) }}" 
                   class="inline-block px-8 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-full hover:border-kamina-blue hover:text-kamina-blue transition-colors">
                    Voir tous les articles
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Style pour l'animation scale-in -->
    <style>
        @keyframes scale-in {
            from { transform: scale(1.1); opacity: 0.8; }
            to { transform: scale(1.0); opacity: 0.7; }
        }
        .animate-scale-in { animation: scale-in 1.5s ease-out forwards; }
    </style>
</div>