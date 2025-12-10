<div>
    <!-- 1. HERO SECTION -->
    <div class="relative bg-kamina-blue h-[500px] flex items-center">
        <!-- Image de fond (Placeholder ou image réelle) -->
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1543791187-df796fa1103d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Cathédrale" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-kamina-blue via-kamina-blue/80 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
            <h1 class="text-4xl md:text-6xl font-bold font-playfair mb-4 leading-tight">
                Diocèse de Kamina <br>
                <span class="text-kamina-gold">Terre d'Espérance</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-100 max-w-2xl mb-8">
                Bienvenue sur le portail officiel. Retrouvez toute l'actualité, les enseignements et la vie pastorale de notre communauté.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('news.index') }}" class="px-8 py-3 bg-kamina-gold hover:bg-yellow-600 text-white font-bold rounded-full transition shadow-lg transform hover:-translate-y-1">
                    Actualités
                </a>
                <a href="#" class="px-8 py-3 bg-transparent border-2 border-white hover:bg-white hover:text-kamina-blue text-white font-bold rounded-full transition">
                    Horaires des Messes
                </a>
            </div>
        </div>
    </div>

    <!-- 2. MOT DE L'ÉVÊQUE -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Photo Évêque -->
                <div class="w-full md:w-1/3">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-kamina-gold/20">
                        <img src="https://via.placeholder.com/400x500" alt="Mgr l'Évêque" class="w-full h-auto object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                            <h3 class="text-white font-bold text-xl">Mgr Léonard KAKUDJI</h3>
                            <p class="text-kamina-gold text-sm">Évêque de Kamina</p>
                        </div>
                    </div>
                </div>
                <!-- Texte -->
                <div class="w-full md:w-2/3">
                    <h2 class="text-kamina-blue font-playfair text-3xl md:text-4xl font-bold mb-6 relative inline-block">
                        Mot de l'Évêque
                        <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-kamina-gold rounded-full"></span>
                    </h2>
                    <div class="prose text-gray-600 text-lg leading-relaxed mb-6">
                        <p>
                            "Chers frères et sœurs dans le Christ, c'est avec une grande joie que je vous accueille sur cet espace numérique..."
                        </p>
                        <p>
                            (Ici, vous pourrez mettre un extrait dynamique de la dernière lettre pastorale ou un message fixe).
                        </p>
                    </div>
                    <a href="#" class="text-kamina-blue font-bold hover:text-kamina-gold transition flex items-center gap-2">
                        Lire la biographie complète
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. DERNIÈRES ACTUALITÉS -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold font-playfair text-gray-800">À la Une</h2>
                    <p class="text-gray-500 mt-2">Les derniers événements du diocèse</p>
                </div>
                <a href="{{ route('news.index') }}" class="hidden md:flex items-center gap-2 text-kamina-blue font-medium hover:text-kamina-gold transition">
                    Voir toutes les actualités
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestPosts as $post)
                    <a href="{{ route('news.show', $post->slug) }}" class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Image -->
                        <div class="h-48 overflow-hidden relative">
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
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->created_at->format('d M Y') }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-kamina-blue transition line-clamp-2">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 100) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500 bg-white rounded-xl">
                        Aucune actualité pour le moment.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('news.index') }}" class="inline-block px-6 py-3 border border-kamina-blue text-kamina-blue font-medium rounded-full hover:bg-kamina-blue hover:text-white transition">
                    Voir toutes les actualités
                </a>
            </div>
        </div>
    </section>
</div>