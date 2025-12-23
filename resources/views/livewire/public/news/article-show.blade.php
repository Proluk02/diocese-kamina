<div class="bg-gradient-to-b from-white to-gray-50/50 dark:from-gray-900 dark:to-gray-800/50 min-h-screen pb-20 transition-colors duration-300">
    
    <!-- Header Immersif avec Parallaxe Amélioré -->
    <!-- AJOUT DE pt-20 pour compenser la navbar fixe -->
    <div class="relative h-[60vh] min-h-[500px] w-full bg-gray-900 overflow-hidden flex items-center justify-center pt-20">
        <!-- Image de fond avec effet parallaxe -->
        <div class="absolute inset-0">
            @if($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" 
                     class="w-full h-full object-cover opacity-60 transform scale-105 animate-scale-in"
                     data-aos="zoom-out"
                     data-aos-duration="1500"
                     alt="{{ $post->title }}">
            @else
                <div class="w-full h-full bg-gradient-to-br from-kamina-blue to-blue-800 flex items-center justify-center">
                    <span class="text-white text-8xl font-bold opacity-10 font-playfair">DK</span>
                </div>
            @endif
            <!-- Overlay gradient plus prononcé pour la lisibilité -->
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-black/30"></div>
            <!-- Texture subtile -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Contenu Header -->
        <div class="relative z-30 max-w-4xl mx-auto px-4 text-center mt-10" data-aos="fade-up" data-aos-delay="300">
            <!-- Bouton retour avec animation -->
            <a href="{{ route('news.index') }}" 
               class="group inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-white/90 hover:text-white px-5 py-2 rounded-full mb-8 transition-all duration-300 hover:bg-white/20 hover:scale-105 shadow-lg">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="text-xs font-bold tracking-widest uppercase">Retour aux actualités</span>
            </a>
            
            <!-- Titre principal -->
            <div class="mb-8">
                <span class="inline-block bg-kamina-gold/90 text-white text-xs font-bold px-4 py-1.5 rounded-full mb-6 shadow-lg tracking-wider uppercase border border-white/20 backdrop-blur-sm">
                    {{ $post->category->name }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white font-playfair leading-tight mb-8 drop-shadow-2xl tracking-tight">
                    {{ $post->title }}
                </h1>
            </div>
            
            <!-- Métadonnées élégantes -->
            <div class="flex flex-wrap items-center justify-center gap-6 text-white/90 text-sm font-medium bg-black/20 inline-flex px-6 py-3 rounded-2xl backdrop-blur-sm border border-white/10">
                <!-- Auteur -->
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-white font-bold text-sm border border-white/30">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                    <div class="text-left leading-tight">
                        <div class="font-bold text-white">{{ $post->user->name }}</div>
                        <div class="text-white/70 text-xs">Auteur</div>
                    </div>
                </div>
                
                <div class="w-px h-8 bg-white/20 hidden sm:block"></div>
                
                <!-- Date -->
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $post->created_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>

    <!-- Contenu Article -->
    <div class="max-w-4xl mx-auto py-16 px-4 sm:px-6 lg:px-8 -mt-20 relative z-30">
        <!-- Carte de contenu flottante -->
        <article class="relative bg-white dark:bg-gray-800 rounded-[2rem] shadow-2xl p-8 md:p-14 border border-gray-100 dark:border-gray-700" 
                 data-aos="fade-up" data-aos-delay="200">
            
            <!-- Décoration d'angle -->
            <div class="absolute top-0 right-0 w-32 h-32 overflow-hidden pointer-events-none">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-kamina-gold/10 to-transparent transform translate-x-16 -translate-y-16 rotate-45"></div>
            </div>
            
            <!-- Navigation de l'article (sticky mobile only) -->
            <div class="lg:hidden sticky top-20 mb-8 z-20">
                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-lg rounded-xl p-4 flex justify-between items-center border border-gray-200 dark:border-gray-700">
                    <span class="text-xs font-bold text-gray-500 uppercase">Partager</span>
                    <div class="flex gap-2">
                         <!-- Boutons partage simplifiés mobile -->
                         <button class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></button>
                         <button class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></button>
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
                       prose-blockquote:italic prose-blockquote:py-4 prose-blockquote:pr-4
                       prose-strong:text-gray-900 dark:prose-strong:text-white
                       prose-ul:list-none prose-ul:pl-0
                       prose-li:relative prose-li:pl-6 prose-li:my-2
                       prose-li:before:content-[''] prose-li:before:absolute prose-li:before:left-0 prose-li:before:top-3 
                       prose-li:before:w-2 prose-li:before:h-2 prose-li:before:rounded-full prose-li:before:bg-kamina-blue
                       leading-relaxed text-gray-700 dark:text-gray-300 font-serif text-lg">
                {!! $post->body !!}
            </div>
            
            <!-- Footer Article : Tags & Partage Desktop -->
            <div class="mt-16 pt-10 border-t border-gray-100 dark:border-gray-700">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-gray-500 uppercase tracking-wide">Catégorie :</span>
                        <a href="{{ route('news.index', ['category' => $post->category->slug]) }}" 
                           class="px-4 py-2 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-lg hover:bg-kamina-blue hover:text-white transition-all">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-4">
                        <span class="text-sm font-bold text-gray-500 uppercase tracking-wide">Partager :</span>
                        <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-all hover:scale-110 shadow-sm"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></button>
                        <button class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-all hover:scale-110 shadow-sm"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></button>
                    </div>
                </div>
            </div>
        </article>

        <!-- Articles Similaires -->
        @if($relatedPosts->count() > 0)
        <div class="mt-24" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center justify-between mb-10 border-b border-gray-200 dark:border-gray-700 pb-4">
                <h3 class="text-3xl font-bold font-playfair text-gray-900 dark:text-white">
                    Dans la même <span class="text-kamina-blue">catégorie</span>
                </h3>
                <a href="{{ route('news.index', ['category' => $post->category->slug]) }}" 
                   class="hidden md:flex items-center gap-2 text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-kamina-blue dark:hover:text-blue-400 transition-colors">
                    Voir plus
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $related)
                    <a href="{{ route('news.show', $related->slug) }}" 
                       class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-700 transform hover:-translate-y-2">
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
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-3 font-semibold uppercase tracking-wider">
                                {{ $related->created_at->format('d M Y') }}
                            </div>
                            
                            <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200 mb-3 line-clamp-2 group-hover:text-kamina-blue dark:group-hover:text-blue-400 transition-colors leading-tight">
                                {{ $related->title }}
                            </h4>
                            
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <span class="text-xs font-bold text-gray-400">{{ $related->category->name }}</span>
                                <span class="text-sm font-semibold text-kamina-blue dark:text-blue-400 group-hover:translate-x-1 transition-transform flex items-center gap-1">
                                    Lire <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
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