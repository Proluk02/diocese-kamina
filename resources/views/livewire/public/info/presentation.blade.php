<div class="bg-brand-light dark:bg-gray-900 min-h-screen transition-colors duration-300">
    
    <!-- HERO HEADER (Parallaxe) -->
    <div class="relative h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden bg-gray-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548625361-9872e4530033?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 class="w-full h-full object-cover opacity-40 transform scale-105"
                 data-aos="zoom-out" data-aos-duration="2000"
                 alt="Cathédrale">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" data-aos="fade-up">
            <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-kamina-gold text-sm font-bold tracking-widest mb-6 uppercase">
                Qui sommes-nous ?
            </span>
            <h1 class="text-5xl md:text-7xl font-bold font-playfair text-white mb-6 leading-tight drop-shadow-2xl">
                Diocèse de <span class="text-kamina-gold italic">{{ $S['site_name'] ?? 'Kamina' }}</span>
            </h1>
            <p class="text-lg md:text-2xl text-blue-100 font-light max-w-2xl mx-auto leading-relaxed">
                Une communauté de foi, d'espérance et de charité.
            </p>
        </div>
    </div>

    <!-- NOTRE HISTOIRE (Dynamique) -->
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <!-- Image -->
                <div class="relative" data-aos="fade-right">
                    <div class="absolute -inset-4 border-2 border-kamina-gold/30 rounded-[2.5rem] transform rotate-3"></div>
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                             alt="Histoire du Diocèse" 
                             class="w-full h-auto object-cover transform hover:scale-105 transition duration-700">
                    </div>
                </div>

                <!-- Texte Dynamique -->
                <div data-aos="fade-left">
                    <h2 class="text-4xl font-bold font-playfair text-gray-900 dark:text-white mb-6 flex items-center gap-4">
                        Notre Histoire
                        <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>
                    </h2>
                    
                    <div class="prose prose-lg dark:prose-invert text-slate-600 dark:text-gray-300 leading-relaxed text-justify">
                        @if(!empty($S['history_text']))
                            {!! $S['history_text'] !!}
                        @else
                            <p class="italic text-gray-500">L'histoire du diocèse sera bientôt disponible.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- L'ÉVÊQUE (Dynamique) -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand-light dark:bg-gray-900 rounded-[3rem] p-8 md:p-12 shadow-xl border border-white/50 dark:border-gray-700 relative overflow-hidden" data-aos="zoom-in">
                
                <div class="flex flex-col md:flex-row items-center gap-12 relative z-10">
                    <!-- Photo -->
                    <div class="w-full md:w-1/3 flex justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-kamina-blue to-kamina-gold rounded-full blur animate-pulse"></div>
                            <img src="{{ asset('storage/img/img1.jpg') }}" 
                                 alt="Mgr l'Évêque" 
                                 class="relative w-64 h-64 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-2xl">
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="w-full md:w-2/3 text-center md:text-left">
                        <div class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-kamina-blue dark:text-blue-300 rounded-lg text-xs font-bold uppercase tracking-wider mb-4">
                            Le Pasteur du Diocèse
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold font-playfair text-gray-900 dark:text-white mb-2">
                            {{ $S['bishop_name'] ?? 'Mgr Léonard KAKUDJI' }}
                        </h2>
                        <p class="text-kamina-gold font-medium text-lg mb-6">Évêque de {{ $S['site_name'] ?? 'Kamina' }}</p>
                        
                        <div class="prose dark:prose-invert text-gray-500 dark:text-gray-400 text-sm">
                            @if(!empty($S['bishop_bio']))
                                {!! $S['bishop_bio'] !!}
                            @else
                                <p>Biographie à venir.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MISSION (Dynamique) -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold font-playfair text-gray-900 dark:text-white">Notre Mission</h2>
                @if(!empty($S['mission_text']))
                    <div class="mt-4 max-w-3xl mx-auto text-gray-500 prose dark:prose-invert">
                        {!! $S['mission_text'] !!}
                    </div>
                @else
                    <p class="text-gray-500 mt-2">Les piliers de notre action pastorale</p>
                @endif
            </div>

            <!-- Cartes Valeurs -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 text-center hover:-translate-y-2 transition duration-300" data-aos="fade-up" data-aos-delay="0">
                    <div class="h-16 w-16 bg-blue-50 dark:bg-blue-900/30 text-kamina-blue dark:text-blue-400 rounded-2xl flex items-center justify-center mx-auto mb-6"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Évangélisation</h3>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 text-center hover:-translate-y-2 transition duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-16 w-16 bg-yellow-50 dark:bg-yellow-900/30 text-kamina-gold rounded-2xl flex items-center justify-center mx-auto mb-6"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg></div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Charité</h3>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 text-center hover:-translate-y-2 transition duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-16 w-16 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-2xl flex items-center justify-center mx-auto mb-6"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Communauté</h3>
                </div>
            </div>
        </div>
    </section>
</div>