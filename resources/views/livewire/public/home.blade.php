<div>
    <!-- 1. HERO SECTION (Modif : ajout d'un overlay plus sombre pour lisibilité) -->
    <div class="relative bg-kamina-blue h-[600px] flex items-center">
        <!-- Image de fond -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Remplacer par une vraie photo de la cathédrale ou d'une messe -->
            <img src="https://images.unsplash.com/photo-1543791187-df796fa1103d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Cathédrale" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-kamina-blue/90 via-kamina-blue/70 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white z-10">
            <div class="max-w-3xl animate-fadeIn">
                <span class="inline-block py-1 px-3 rounded-full bg-kamina-gold/20 border border-kamina-gold/50 text-kamina-gold text-sm font-semibold mb-4 tracking-wider uppercase">
                    Église Catholique en RDC
                </span>
                <h1 class="text-4xl md:text-6xl font-bold font-playfair mb-6 leading-tight drop-shadow-lg">
                    Diocèse de Kamina <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-kamina-gold to-yellow-300">Terre d'Espérance</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 mb-10 leading-relaxed max-w-2xl">
                    Bienvenue sur le portail officiel. Retrouvez toute l'actualité, les enseignements de l'évêque et la vie pastorale de notre communauté.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('news.index') }}" class="px-8 py-4 bg-kamina-gold hover:bg-yellow-600 text-white font-bold rounded-full transition shadow-lg transform hover:-translate-y-1 flex items-center gap-2">
                        Lire les actualités
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </a>
                    <a href="{{ route('parishes.public.index') }}" class="px-8 py-4 bg-transparent border-2 border-white hover:bg-white hover:text-kamina-blue text-white font-bold rounded-full transition flex items-center gap-2">
                        Trouver une paroisse
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MOT DE L'ÉVÊQUE -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-20">
                <!-- Photo -->
                <div class="w-full md:w-5/12 relative">
                    <div class="absolute inset-0 bg-kamina-gold rounded-2xl transform translate-x-4 translate-y-4"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <!-- Mettre une vraie photo ici -->
                        <img src="https://via.placeholder.com/600x800" alt="Mgr l'Évêque" class="w-full h-auto object-cover transform hover:scale-105 transition duration-700">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent p-8 text-white">
                            <h3 class="font-playfair font-bold text-2xl">Mgr Léonard KAKUDJI</h3>
                            <p class="text-kamina-gold font-medium uppercase tracking-widest text-sm mt-1">Évêque de Kamina</p>
                        </div>
                    </div>
                </div>
                <!-- Texte -->
                <div class="w-full md:w-7/12">
                    <span class="text-kamina-gold font-bold tracking-widest uppercase text-sm">Éditorial</span>
                    <h2 class="text-kamina-blue font-playfair text-4xl md:text-5xl font-bold mb-8 mt-2 leading-tight">
                        "Duc in Altum !" <br>
                        <span class="text-gray-400 text-3xl italic font-serif">Avance au large</span>
                    </h2>
                    <div class="prose prose-lg text-gray-600 mb-8 leading-relaxed">
                        <p>
                            Chers frères et sœurs dans le Christ, c'est avec une grande joie et une profonde espérance que je vous accueille sur cet espace numérique dédié à notre diocèse.
                        </p>
                        <p>
                            En ces temps de défis, notre Église se doit d'être une lumière, un refuge et une force. Ce site est conçu pour être un pont entre nos paroisses, nos mouvements et chacun de vous.
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <img src="https://via.placeholder.com/150x80?text=Signature" alt="Signature" class="h-16 opacity-60">
                        <a href="#" class="text-kamina-blue font-bold hover:text-kamina-gold transition flex items-center gap-2 border-b-2 border-kamina-blue hover:border-kamina-gold pb-1">
                            Lire la biographie
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. ACTUALITÉS (MODULE A) -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="max-w-2xl">
                    <h2 class="text-3xl md:text-4xl font-bold font-playfair text-gray-900 mb-4">La Vie du Diocèse</h2>
                    <p class="text-gray-600 text-lg">Découvrez les derniers événements, les nominations et les nouvelles de nos communautés.</p>
                </div>
                <a href="{{ route('news.index') }}" class="hidden md:flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-full text-kamina-blue font-bold hover:bg-kamina-blue hover:text-white transition shadow-sm">
                    Toutes les actualités
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestPosts as $post)
                    <article class="flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group h-full">
                        <!-- Image -->
                        <div class="h-56 overflow-hidden relative">
                            <a href="{{ route('news.show', $post->slug) }}">
                                @if($post->image_path)
                                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </a>
                            <div class="absolute top-4 left-4">
                                <span class="bg-kamina-gold text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide shadow-md">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3 font-medium uppercase tracking-wider">
                                <svg class="w-4 h-4 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->created_at->format('d M Y') }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-kamina-blue transition leading-snug">
                                <a href="{{ route('news.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-1">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 120) }}
                            </p>
                            <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center text-kamina-blue font-bold text-sm hover:text-kamina-gold transition">
                                Lire la suite
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">Aucune actualité publiée pour le moment.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-10 text-center md:hidden">
                <a href="{{ route('news.index') }}" class="inline-block w-full px-6 py-4 bg-white border border-gray-200 text-kamina-blue font-bold rounded-xl shadow-sm">
                    Voir toutes les actualités
                </a>
            </div>
        </div>
    </section>

    <!-- 4. PAROISSES & SERVICES (MODULE B) -->
    <section class="py-20 relative bg-kamina-blue overflow-hidden">
        <!-- Motif de fond -->
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-white">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-bold font-playfair mb-6">Au service de la communauté</h2>
                <p class="text-blue-100 text-lg">
                    Le diocèse est organisé en paroisses et services pour être au plus près de vous. Trouvez votre lieu de culte ou accédez aux ressources.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Carte Paroisses -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition duration-300 text-center group">
                    <div class="h-16 w-16 bg-white text-kamina-blue rounded-full flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold font-playfair mb-4">Nos Paroisses</h3>
                    <p class="text-blue-100 mb-8">Consultez l'annuaire des églises, les horaires des messes et contactez les prêtres.</p>
                    <a href="{{ route('parishes.public.index') }}" class="inline-block px-6 py-3 bg-kamina-gold hover:bg-yellow-600 text-white font-bold rounded-lg transition shadow-md">
                        Trouver une église
                    </a>
                </div>

                <!-- Carte Liturgie -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition duration-300 text-center group">
                    <div class="h-16 w-16 bg-white text-kamina-blue rounded-full flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold font-playfair mb-4">Chants & Liturgie</h3>
                    <p class="text-blue-100 mb-8">Accédez à notre médiathèque : partitions, audios et textes liturgiques pour animer vos célébrations.</p>
                    <a href="#" class="inline-block px-6 py-3 bg-white hover:bg-gray-100 text-kamina-blue font-bold rounded-lg transition shadow-md">
                        Médiathèque
                    </a>
                </div>

                <!-- Carte Documents -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition duration-300 text-center group">
                    <div class="h-16 w-16 bg-white text-kamina-blue rounded-full flex items-center justify-center text-3xl mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold font-playfair mb-4">Documents Officiels</h3>
                    <p class="text-blue-100 mb-8">Téléchargez les homélies, lettres pastorales et communiqués officiels de l'évêché.</p>
                    <a href="#" class="inline-block px-6 py-3 bg-transparent border-2 border-white hover:bg-white hover:text-kamina-blue font-bold rounded-lg transition">
                        Consulter
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. APPEL À L'ACTION (Newsletter ou Contact) -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold font-playfair text-gray-900 mb-4">Restez informés</h2>
            <p class="text-gray-600 mb-8">Abonnez-vous à notre newsletter pour recevoir les nouvelles du diocèse directement dans votre boîte mail.</p>
            <form class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg mx-auto">
                <input type="email" placeholder="Votre adresse email" class="flex-1 px-5 py-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-kamina-gold focus:border-transparent outline-none">
                <button type="submit" class="px-8 py-3 bg-kamina-blue text-white font-bold rounded-full hover:bg-blue-800 transition shadow-lg">
                    S'abonner
                </button>
            </form>
        </div>
    </section>
</div>