<div class="overflow-x-hidden bg-brand-light dark:bg-gray-900 transition-colors duration-300">
    
    <!-- ========================================================= -->
    <!-- 1. HERO CARROUSEL (DYNAMIQUE) -->
    <!-- ========================================================= -->
    <div class="relative h-[650px] md:h-[800px] overflow-hidden bg-gray-900" 
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

        <!-- SLIDES -->
        <template x-for="(slide, index) in slides" :key="index">
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                 :class="activeSlide === index ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                
                <!-- Image : Vérifie si c'est une image par défaut ou une image uploadée -->
                <img :src="slide.includes('default') || slide.startsWith('http') ? slide : '/storage/' + slide" 
                     class="w-full h-full object-cover transform scale-105 origin-center transition-transform duration-[10000ms]"
                     :class="activeSlide === index ? 'scale-110' : 'scale-100'"
                     alt="Diocèse de Kamina">
                
                <!-- Overlay Dégradé (Pour lisibilité texte) -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-brand-light dark:to-gray-900"></div>
            </div>
        </template>

        <!-- CONTENU TEXTE (Fixe par dessus les slides) -->
        <div class="absolute inset-0 z-20 flex items-center justify-center text-center px-4">
            <div class="max-w-5xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
                
                <div class="inline-flex items-center gap-3 py-1 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-blue-50 text-sm font-semibold tracking-widest mb-6 shadow-lg">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    PORTAIL OFFICIEL
                </div>

                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold font-playfair text-white mb-6 leading-tight drop-shadow-2xl">
                    Diocèse de Kamina <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-kamina-gold to-yellow-200 italic">Terre d'Espérance</span>
                </h1>

                <p class="text-lg md:text-2xl text-gray-100 max-w-2xl mx-auto mb-10 font-light drop-shadow-md leading-relaxed">
                    Une Église famille, unie dans la prière, engagée dans la charité et tournée vers l'avenir de notre communauté.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('news.index') }}" class="px-8 py-4 bg-kamina-gold hover:bg-yellow-600 text-white font-bold rounded-full transition-all shadow-lg shadow-yellow-500/30 transform hover:-translate-y-1 hover:shadow-xl">
                        Suivre l'actualité
                    </a>
                    <a href="{{ route('parishes.public.index') }}" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/50 text-white font-bold rounded-full hover:bg-white hover:text-kamina-blue transition-all">
                        Trouver une paroisse
                    </a>
                </div>
            </div>
        </div>

        <!-- INDICATEURS (Dots) -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-30 flex gap-3" x-show="slides.length > 1">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index; resetTimer()" 
                        class="h-2 rounded-full transition-all duration-300"
                        :class="activeSlide === index ? 'bg-kamina-gold w-8' : 'bg-white/50 w-2 hover:bg-white'">
                </button>
            </template>
        </div>
        
        <!-- SCROLL INDICATOR -->
        <div class="absolute bottom-8 right-8 z-30 hidden md:block animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 2. MOT DE L'ÉVÊQUE (Section Blanche/Clean) -->
    <!-- ========================================================= -->
    <section class="py-24 bg-brand-surface dark:bg-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-16">
                
                <!-- Image avec effet -->
                <div class="w-full md:w-5/12" data-aos="fade-right">
                    <div class="relative group">
                        <div class="absolute -inset-3 bg-gradient-to-tr from-kamina-blue to-kamina-gold rounded-2xl opacity-20 group-hover:opacity-40 transition duration-500 blur-lg"></div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <!-- Placeholder: Remplacez par la vraie photo de l'évêque -->
                            <img src="{{ asset('storage/img/img1.jpg') }}" 
                                 alt="Mgr l'Évêque" 
                                 class="w-full h-auto object-cover transform transition duration-700 group-hover:scale-105">
                            
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-kamina-blue/90 to-transparent p-6 pt-20">
                                <h3 class="text-white font-bold text-xl font-playfair">Mgr Léonard KAKUDJI</h3>
                                <p class="text-kamina-gold text-sm font-medium tracking-wider uppercase">Évêque de Kamina</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Texte -->
                <div class="w-full md:w-7/12" data-aos="fade-left">
                    <div class="inline-flex items-center gap-2 text-kamina-gold font-bold uppercase tracking-wider mb-4 text-xs">
                        <span class="w-10 h-0.5 bg-kamina-gold"></span> Le Pasteur
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-bold font-playfair text-gray-900 dark:text-white mb-8">
                        Bienvenue chez Vous
                    </h2>
                    
                    <div class="relative mb-8">
                        <svg class="absolute -top-4 -left-6 w-12 h-12 text-gray-200 dark:text-gray-700 transform -scale-x-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.0547 15.3789 13.9141 17.6172 12.375C15.3359 11.8359 14.017 10.4375 14.017 8.36719C14.017 5.70312 16.2734 3.79688 18.5781 3.79688C20.9297 3.79688 23.0781 5.60156 23.0781 9.07031C23.0781 14.3047 18.7344 21 14.017 21ZM5.39062 21L5.39062 18C5.39062 16.0547 6.75781 13.9141 8.98438 12.375C6.70312 11.8359 5.39062 10.4375 5.39062 8.36719C5.39062 5.70312 7.64062 3.79688 9.94531 3.79688C12.2969 3.79688 14.4453 5.60156 14.4453 9.07031C14.4453 14.3047 10.1016 21 5.39062 21Z"/></svg>
                        <blockquote class="text-xl text-slate-600 dark:text-gray-300 italic pl-6 border-l-4 border-kamina-blue leading-relaxed relative z-10">
                            "Chers frères et sœurs, que ce site soit un pont entre nos paroisses, nos communautés et le monde. Bâtissons ensemble une communauté fondée sur l'amour, la solidarité et la foi inébranlable en notre Seigneur."
                        </blockquote>
                    </div>

                    <p class="text-slate-500 dark:text-gray-400 leading-relaxed mb-8">
                        À travers ces pages, vous découvrirez la vitalité de nos œuvres, la richesse de notre liturgie et l'engagement de nos prêtres et laïcs. Que votre visite soit fructueuse et spirituelle.
                    </p>

                    <a href="{{ route('presentation') }}" class="inline-flex items-center text-kamina-blue dark:text-kamina-gold font-bold hover:underline group">
                        Lire la biographie complète
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 3. ACTUALITÉS (Fond doux) -->
    <!-- ========================================================= -->
    <section class="py-24 bg-brand-light dark:bg-gray-900 transition-colors duration-300 relative">
        <!-- Décoration fond -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-200 dark:via-gray-700 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-aos="fade-up">
                <div>
                    <span class="text-kamina-blue dark:text-blue-400 font-bold uppercase tracking-wider text-sm mb-2 block">Blog & Événements</span>
                    <h2 class="text-4xl font-bold font-playfair text-gray-900 dark:text-white">À la Une</h2>
                </div>
                <a href="{{ route('news.index') }}" class="hidden md:flex items-center gap-2 px-5 py-2 rounded-full border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-medium hover:border-kamina-blue hover:text-kamina-blue dark:hover:text-white transition">
                    Toutes les actualités
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestPosts as $index => $post)
                    <article class="group bg-brand-surface dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-brand-border dark:border-gray-700 flex flex-col h-full transform hover:-translate-y-1" 
                             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        
                        <!-- Image -->
                        <div class="h-60 overflow-hidden relative">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <!-- Catégorie -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/95 dark:bg-gray-900/90 backdrop-blur text-kamina-blue dark:text-blue-300 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500 mb-3 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->created_at->format('d M Y') }}
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-kamina-blue dark:group-hover:text-kamina-gold transition-colors line-clamp-2 leading-tight">
                                <a href="{{ route('news.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            <p class="text-slate-500 dark:text-gray-400 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 110) }}
                            </p>
                            
                            <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                                <a href="{{ route('news.show', $post->slug) }}" class="text-sm font-bold text-kamina-blue dark:text-blue-400 group-hover:underline">
                                    Lire l'article
                                </a>
                                <div class="h-8 w-8 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 group-hover:bg-kamina-blue group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <div class="inline-block p-4 rounded-full bg-gray-100 dark:bg-gray-800 mb-4 text-gray-400">
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
    <!-- 4. BANNIÈRE SERVICES (Accès Rapides) -->
    <!-- ========================================================= -->
    <section class="py-20 bg-kamina-blue dark:bg-blue-900 relative overflow-hidden">
        <!-- Texture subtile -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-kamina-gold/20 rounded-full blur-3xl -ml-20 -mb-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold font-playfair text-white mb-2">Vie du Diocèse</h2>
                <p class="text-blue-200">Accédez rapidement aux informations essentielles.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Carte 1 -->
                <a href="{{ route('parishes.public.index') }}" class="group p-8 rounded-3xl bg-white/5 hover:bg-white/10 border border-white/10 backdrop-blur-sm transition duration-300 text-center" data-aos="fade-up" data-aos-delay="0">
                    <div class="h-20 w-20 bg-gradient-to-br from-kamina-gold to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Paroisses & Messes</h3>
                    <p class="text-blue-100 text-sm opacity-80">Trouvez l'église la plus proche et consultez les horaires.</p>
                </a>

                <!-- Carte 2 -->
                <a href="{{ route('liturgy.public.index') }}" class="group p-8 rounded-3xl bg-white/5 hover:bg-white/10 border border-white/10 backdrop-blur-sm transition duration-300 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-20 w-20 bg-gradient-to-br from-kamina-gold to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Liturgie & Chants</h3>
                    <p class="text-blue-100 text-sm opacity-80">Notre bibliothèque de chants sacrés, partitions et audios.</p>
                </a>

                <!-- Carte 3 -->
                <a href="{{ route('documents.public.index') }}" class="group p-8 rounded-3xl bg-white/5 hover:bg-white/10 border border-white/10 backdrop-blur-sm transition duration-300 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-20 w-20 bg-gradient-to-br from-kamina-gold to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Documents Officiels</h3>
                    <p class="text-blue-100 text-sm opacity-80">Accédez aux homélies, lettres pastorales et communiqués.</p>
                </a>
            </div>
        </div>
    </section>

</div>