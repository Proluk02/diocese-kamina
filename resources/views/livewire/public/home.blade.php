<div class="overflow-x-hidden bg-brand-light dark:bg-gray-900 transition-colors duration-300">
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gray-900" 
         x-data="{ 
            activeSlide: 0, 
            slides: {{ json_encode($slides) }},
            timer: null,
            init() {
                if(this.slides.length > 1) {
                    this.startTimer();
                }
            },
            startTimer() {
                this.timer = setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                }, 6000);
            },
            resetTimer() {
                clearInterval(this.timer);
                this.startTimer();
            }
         }">

        <!-- SLIDES (Background) -->
        <template x-for="(slide, index) in slides" :key="index">
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                 :class="activeSlide === index ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                
                <img :src="slide.includes('default') || slide.startsWith('http') ? slide : '/storage/' + slide" 
                     class="w-full h-full object-cover transform scale-105 origin-center transition-transform duration-[10000ms]"
                     :class="activeSlide === index ? 'scale-110' : 'scale-100'"
                     alt="Diocèse de Kamina">
                
                <!-- Overlay Sombre (Essentiel pour le menu transparent) -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/60"></div>
            </div>
        </template>

        <!-- CONTENU TEXTE (Centré) -->
        <div class="relative z-20 text-center px-4 w-full max-w-5xl mx-auto pt-20" data-aos="fade-up" data-aos-duration="1000">
            
            <div class="inline-flex items-center gap-3 py-1.5 px-5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-blue-50 text-sm font-bold tracking-widest mb-8 shadow-xl">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                PORTAIL OFFICIEL
            </div>

            <!-- TITRE AJUSTÉ -->
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold font-playfair text-white mb-6 leading-tight drop-shadow-2xl tracking-tight">
                Diocèse de Kamina <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-kamina-gold via-yellow-200 to-kamina-gold italic">Terre d'Espérance</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-10 font-light drop-shadow-md leading-relaxed">
                Une Église famille, unie dans la prière, engagée dans la charité et tournée vers l'avenir de notre communauté.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('news.index') }}" class="px-8 py-3.5 bg-kamina-gold hover:bg-yellow-600 text-white font-bold text-lg rounded-full transition-all shadow-lg shadow-yellow-500/30 transform hover:-translate-y-1 hover:shadow-xl hover:scale-105">
                    Suivre l'actualité
                </a>
                <a href="{{ route('parishes.public.index') }}" class="px-8 py-3.5 bg-white/10 backdrop-blur-md border border-white/50 text-white font-bold text-lg rounded-full hover:bg-white hover:text-kamina-blue transition-all transform hover:-translate-y-1">
                    Trouver une paroisse
                </a>
            </div>
        </div>

        <!-- INDICATEURS -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-30 flex gap-3" x-show="slides.length > 1">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index; resetTimer()" 
                        class="h-1.5 rounded-full transition-all duration-300"
                        :class="activeSlide === index ? 'bg-kamina-gold w-12' : 'bg-white/40 w-6 hover:bg-white'">
                </button>
            </template>
        </div>
        
        <!-- SCROLL MOUSE -->
        <div class="absolute bottom-8 right-8 z-30 hidden lg:flex flex-col items-center gap-2 animate-bounce">
            <span class="text-white/60 text-xs tracking-widest uppercase writing-vertical">Scroll</span>
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 2. MOT DE L'ÉVÊQUE (MODERNISÉ & DYNAMIQUE) -->
    <!-- ========================================================= -->
    <section class="py-24 bg-brand-surface dark:bg-gray-800 transition-colors duration-300 relative">
        <!-- Pattern décoratif -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gray-50 dark:bg-gray-800/50 skew-x-12 transform origin-top-right z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                
                <div class="w-full lg:w-5/12" data-aos="fade-right">
                    <div class="relative">
                        <!-- Cadre décoratif -->
                        <div class="absolute -top-4 -left-4 w-full h-full border-2 border-kamina-gold rounded-3xl z-0"></div>
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl z-10 aspect-[3/4]">
                            
                            <!-- PHOTO DYNAMIQUE (Depuis l'Admin) -->
                            @if(!empty($S['bishop_photo_path']))
                                <img src="{{ asset('storage/' . $S['bishop_photo_path']) }}" 
                                     alt="Mgr l'Évêque" 
                                     class="w-full h-full object-cover transform transition duration-700 hover:scale-105">
                            @else
                                <!-- Image par défaut si pas uploadée -->
                                <img src="{{ asset('storage/img/img2.jpg') }}" 
                                     alt="Mgr l'Évêque" 
                                     class="w-full h-full object-cover transform transition duration-700 hover:scale-105">
                            @endif
                            
                            <!-- Cartouche Nom -->
                            <div class="absolute bottom-6 left-6 right-6 bg-white/95 dark:bg-gray-900/95 backdrop-blur rounded-xl p-4 shadow-lg text-center border-l-4 border-kamina-gold">
                                <h3 class="text-gray-900 dark:text-white font-bold text-xl font-playfair">{{ $S['bishop_name'] ?? 'Mgr Léonard KAKUDJI' }}</h3>
                                <p class="text-kamina-blue dark:text-blue-400 text-xs font-bold tracking-widest uppercase mt-1">Évêque de Kamina</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-7/12" data-aos="fade-left">
                    <div class="inline-flex items-center gap-3 text-kamina-gold font-bold uppercase tracking-wider mb-6 text-xs bg-yellow-50 dark:bg-yellow-900/20 px-3 py-1 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-kamina-gold"></span> Le Pasteur
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 dark:text-white mb-8 leading-tight">
                        Bienvenue <br> <span class="text-kamina-blue dark:text-blue-400">chez Vous</span>
                    </h2>
                    
                    <div class="relative mb-10 pl-8">
                        <svg class="absolute -top-4 -left-4 w-12 h-12 text-gray-100 dark:text-gray-700 transform -scale-x-100 -z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.0547 15.3789 13.9141 17.6172 12.375C15.3359 11.8359 14.017 10.4375 14.017 8.36719C14.017 5.70312 16.2734 3.79688 18.5781 3.79688C20.9297 3.79688 23.0781 5.60156 23.0781 9.07031C23.0781 14.3047 18.7344 21 14.017 21ZM5.39062 21L5.39062 18C5.39062 16.0547 6.75781 13.9141 8.98438 12.375C6.70312 11.8359 5.39062 10.4375 5.39062 8.36719C5.39062 5.70312 7.64062 3.79688 9.94531 3.79688C12.2969 3.79688 14.4453 5.60156 14.4453 9.07031C14.4453 14.3047 10.1016 21 5.39062 21Z"/></svg>
                        <blockquote class="text-xl md:text-2xl text-slate-700 dark:text-gray-200 italic font-serif leading-relaxed">
                            "Chers frères et sœurs, que ce site soit un pont entre nos paroisses et le monde. Bâtissons ensemble une communauté fondée sur l'amour."
                        </blockquote>
                    </div>

                    <p class="text-slate-500 dark:text-gray-400 text-lg leading-relaxed mb-10">
                        À travers ces pages, vous découvrirez la vitalité de nos œuvres, la richesse de notre liturgie et l'engagement de nos prêtres et laïcs. Que votre visite soit fructueuse et spirituelle.
                    </p>

                    <a href="{{ route('presentation') }}" class="group inline-flex items-center text-white bg-kamina-blue hover:bg-blue-800 px-8 py-3 rounded-full font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                        Lire la biographie complète
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 3. ACTUALITÉS (DESIGN CARTES FLOTTANTES) -->
    <!-- ========================================================= -->
    <section class="py-24 bg-brand-light dark:bg-gray-900 transition-colors duration-300 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-aos="fade-up">
                <div>
                    <span class="text-kamina-blue dark:text-blue-400 font-bold uppercase tracking-wider text-sm mb-2 block">Blog & Événements</span>
                    <h2 class="text-3xl md:text-4xl font-bold font-playfair text-gray-900 dark:text-white">À la Une</h2>
                </div>
                <a href="{{ route('news.index') }}" class="hidden md:flex items-center gap-2 px-6 py-2.5 rounded-full border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-medium hover:border-kamina-blue hover:text-kamina-blue dark:hover:text-white hover:bg-white dark:hover:bg-gray-800 transition shadow-sm">
                    Toutes les actualités
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @forelse($latestPosts as $index => $post)
                    <article class="group relative flex flex-col h-full bg-white dark:bg-gray-800 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700" 
                             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        
                        <!-- Image -->
                        <div class="h-64 overflow-hidden relative">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 dark:bg-gray-900/90 backdrop-blur text-kamina-blue dark:text-blue-300 text-xs font-bold px-3 py-1.5 rounded-lg shadow-md border border-white/20">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-8 flex-1 flex flex-col relative">
                            <!-- Date en petit -->
                            <div class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                                {{ $post->created_at->format('d M Y') }}
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-kamina-blue dark:group-hover:text-kamina-gold transition-colors line-clamp-2">
                                <a href="{{ route('news.show', $post->slug) }}" class="focus:outline-none">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            <p class="text-slate-500 dark:text-gray-400 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 110) }}
                            </p>
                            
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-xs font-bold text-gray-600 dark:text-gray-300">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $post->user->name }}</span>
                                </div>
                                <span class="text-kamina-blue dark:text-kamina-gold text-sm font-bold group-hover:translate-x-1 transition-transform">
                                    Lire <span class="sr-only">l'article</span> →
                                </span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <div class="inline-block p-4 rounded-full bg-white dark:bg-gray-800 shadow-sm mb-4 text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">Aucune actualité récente.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12 text-center md:hidden">
                <a href="{{ route('news.index') }}" class="inline-block px-8 py-3 bg-white border border-gray-200 text-kamina-blue font-bold rounded-full shadow-sm">
                    Voir le blog
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 4. BANNIÈRE SERVICES (Accès Rapides Modernisés) -->
    <!-- ========================================================= -->
    <section class="py-24 bg-gradient-to-br from-kamina-blue via-blue-800 to-blue-900 dark:from-gray-900 dark:via-blue-950 dark:to-blue-900 relative overflow-hidden">
        <!-- Éléments décoratifs -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-kamina-gold/20 rounded-full blur-3xl"></div>
        </div>
        
        <!-- Pattern subtil -->
        <div class="absolute inset-0 opacity-[0.02]" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- En-tête avec tagline -->
            <div class="text-center mb-20" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 text-blue-200 text-sm font-semibold uppercase tracking-wider mb-6">
                    <div class="h-px w-8 bg-blue-400"></div>
                    Accès Rapide
                    <div class="h-px w-8 bg-blue-400"></div>
                </div>
                <h2 class="text-3xl md:text-5xl font-bold font-playfair text-white mb-6">
                    Explorez la <span class="text-transparent bg-clip-text bg-gradient-to-r from-kamina-gold to-yellow-300">Vie du Diocèse</span>
                </h2>
                <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                    Portails essentiels pour votre cheminement spirituel et votre engagement communautaire
                </p>
            </div>

            <!-- DISPOSITION EN DIAMANT/CARROUSEL -->
            <div class="relative" x-data="{ activeCard: 0 }">
                <!-- Cartes principales -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $services = [
                            [
                                'route' => 'parishes.public.index',
                                'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                                'title' => 'Paroisses & Messes',
                                'desc' => 'Trouvez l\'église la plus proche, consultez les horaires et rejoignez une communauté.',
                                'color' => 'from-kamina-gold to-yellow-600'
                            ],
                            [
                                'route' => 'liturgy.public.index',
                                'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3',
                                'title' => 'Liturgie & Chants',
                                'desc' => 'Bibliothèque de chants sacrés, partitions et audios pour vos célébrations.',
                                'color' => 'from-blue-400 to-blue-600'
                            ],
                            [
                                'route' => 'documents.public.index',
                                'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                                'title' => 'Documents Officiels',
                                'desc' => 'Accédez aux homélies, lettres pastorales et communiqués de l\'Évêché.',
                                'color' => 'from-green-400 to-green-600'
                            ]
                        ];
                    @endphp

                    @foreach($services as $index => $service)
                        <div class="relative" 
                             @mouseenter="activeCard = {{ $index }}" 
                             @mouseleave="activeCard = null"
                             data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                            <!-- Carte principale -->
                            <a href="{{ route($service['route']) }}" 
                               class="group relative block h-full p-8 rounded-[2rem] bg-white/[0.08] border border-white/20 backdrop-blur-xl transition-all duration-500 hover:bg-white/[0.12] hover:-translate-y-4 hover:shadow-2xl hover:shadow-blue-500/20">
                                <!-- Effet de lumière au hover -->
                                <div class="absolute inset-0 bg-gradient-to-br {{ $service['color'] }} opacity-0 group-hover:opacity-10 transition-opacity duration-500 rounded-[2rem]"></div>
                                
                                <!-- Icone animée -->
                                <div class="relative mb-8">
                                    <div class="absolute inset-0 bg-gradient-to-br {{ $service['color'] }} opacity-20 blur-xl rounded-2xl transform group-hover:scale-125 transition-transform duration-500"></div>
                                    <div class="relative h-24 w-24 bg-gradient-to-br {{ $service['color'] }} rounded-2xl flex items-center justify-center mx-auto shadow-2xl group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $service['icon'] }}"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Contenu texte -->
                                <div class="relative text-center">
                                    <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-kamina-gold transition-colors">
                                        {{ $service['title'] }}
                                    </h3>
                                    <p class="text-blue-100/80 text-sm leading-relaxed mb-6">
                                        {{ $service['desc'] }}
                                    </p>
                                    
                                    <!-- Bouton d'accès -->
                                    <div class="inline-flex items-center gap-2 text-sm font-semibold text-white/80 group-hover:text-white transition-colors">
                                        Accéder
                                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- Ligne de connexion (visuelle) -->
                            @if($index < count($services) - 1)
                                <div class="hidden md:block absolute top-1/2 right-0 w-full h-0.5 bg-gradient-to-r from-transparent via-white/30 to-transparent transform translate-x-1/2 -translate-y-1/2 z-0"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <!-- Points indicateurs (mobile) -->
                <div class="flex justify-center gap-3 mt-12 md:hidden">
                    @foreach($services as $index => $service)
                        <button class="h-2 rounded-full transition-all duration-300"
                                :class="activeCard === {{ $index }} ? 'bg-white w-8' : 'bg-white/30 w-4'"
                                @click="activeCard = {{ $index }}">
                        </button>
                    @endforeach
                </div>
            </div>
            
            <!-- Appel à action -->
            <div class="text-center mt-20" data-aos="fade-up" data-aos-delay="300">
                <p class="text-blue-100 text-lg mb-8">Vous souhaitez vous engager davantage ?</p>
                <a href="{{ route('contact') }}" 
                   class="group inline-flex items-center gap-3 px-10 py-4 bg-white text-kamina-blue font-bold text-lg rounded-full hover:bg-blue-50 transition-all duration-300 shadow-2xl hover:shadow-3xl hover:-translate-y-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    Nous contacter
                </a>
            </div>
        </div>
    </section>

</div>