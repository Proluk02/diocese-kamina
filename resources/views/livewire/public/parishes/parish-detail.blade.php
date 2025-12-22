<div class="bg-brand-light dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <!-- Hero Immersif -->
    <div class="relative h-[65vh] min-h-[500px] w-full bg-gray-900 overflow-hidden flex items-center justify-center">
        <!-- Image de fond avec Parallaxe -->
        <div class="absolute inset-0">
            @if($parish->photo_path)
                <img src="{{ asset('storage/' . $parish->photo_path) }}" 
                     class="w-full h-full object-cover opacity-60 transform scale-105"
                     data-aos="zoom-out" data-aos-duration="1500">
            @else
                <div class="w-full h-full bg-gradient-to-br from-kamina-blue to-blue-900 opacity-40"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/30 to-transparent"></div>
        </div>

        <!-- Contenu Header -->
        <div class="relative z-20 max-w-7xl mx-auto px-4 w-full pt-20" data-aos="fade-up">
            <a href="{{ route('parishes.public.index') }}" class="inline-flex items-center text-white/80 hover:text-white mb-8 transition-colors text-sm font-bold tracking-widest uppercase">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour aux paroisses
            </a>
            
            <div class="max-w-4xl">
                <span class="bg-kamina-gold text-white px-4 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider mb-6 inline-block shadow-lg">
                    Paroisse de {{ $parish->city }}
                </span>
                <h1 class="text-5xl md:text-4xl font-bold text-white font-playfair leading-tight mb-6 drop-shadow-2xl">
                    {{ $parish->name }}
                </h1>
                <p class="text-xl text-gray-200 flex items-center gap-3 font-light">
                    <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    {{ $parish->address }}
                </p>
            </div>
        </div>
    </div>

    <!-- Contenu Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-30">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Colonne Gauche : Histoire & Clergé -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Histoire -->
                <section class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl p-8 md:p-14 border border-gray-100 dark:border-gray-700" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white font-playfair mb-8 flex items-center gap-4">
                        Notre Histoire
                        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-700"></div>
                    </h2>
                    @if(!empty($parish->history))
                        <div class="prose prose-lg dark:prose-invert text-gray-600 dark:text-gray-300 max-w-none leading-relaxed text-justify font-serif ql-editor px-0">
                            {!! $parish->history !!}
                        </div>
                    @else
                        <div class="p-10 text-center bg-gray-50 dark:bg-gray-900/50 rounded-3xl text-gray-400 italic">
                            L'histoire de cette paroisse est en cours de rédaction par le secrétariat.
                        </div>
                    @endif
                </section>

                <!-- Clergé -->
                @if($parish->users->whereIn('role', ['priest', 'bishop'])->count() > 0)
                <section data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white font-playfair mb-8">Responsables du Clergé</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($parish->users->whereIn('role', ['priest', 'bishop']) as $priest)
                            <div class="flex items-center gap-5 p-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm hover:shadow-md transition-all group">
                                <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-kamina-blue to-blue-800 text-white flex items-center justify-center font-bold text-2xl shadow-lg group-hover:scale-110 transition-transform">
                                    {{ substr($priest->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ $priest->name }}</h4>
                                    <p class="text-xs font-bold text-kamina-gold uppercase tracking-widest mt-1">
                                        {{ $priest->role === 'bishop' ? 'Évêque' : 'Prêtre' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Colonne Droite : Horaires & Contact (Sticky) -->
            <div class="lg:col-span-1">
                <div class="space-y-8 sticky top-32" data-aos="fade-left">
                    <!-- Horaires -->
                    <div class="bg-gradient-to-br from-white to-blue-50/50 dark:from-gray-800 dark:to-blue-900/10 rounded-[2.5rem] p-10 border border-blue-100 dark:border-blue-900/30 shadow-2xl relative overflow-hidden">
                        <!-- Décoration -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-kamina-blue/5 rounded-full"></div>
                        
                        <h3 class="text-2xl font-bold text-kamina-blue dark:text-blue-300 font-playfair mb-8 flex items-center gap-3">
                            <svg class="w-7 h-7 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Messes
                        </h3>
                        
                        @if(!empty($parish->mass_schedules))
                            <div class="prose dark:prose-invert prose-sm text-gray-700 dark:text-gray-300 ql-editor px-0 font-medium">
                                {!! $parish->mass_schedules !!}
                            </div>
                        @else
                            <p class="text-gray-400 italic text-center py-4">Horaires à venir.</p>
                        @endif

                        <div class="border-t border-blue-100 dark:border-blue-900/50 my-8"></div>

                        <div class="space-y-6">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Contact Direct</h4>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $parish->contact_phone ?? 'Non renseigné' }}</p>
                            </div>
                            
                            <a href="{{ route('contact') }}" class="group flex items-center justify-center gap-3 w-full py-4 bg-kamina-blue hover:bg-blue-800 text-white font-bold rounded-2xl shadow-lg transition-all transform hover:-translate-y-1">
                                Écrire au secrétariat
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Invitation Don -->
                    <div class="bg-gray-900 rounded-[2rem] p-8 text-center text-white shadow-xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-kamina-gold opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <h4 class="text-lg font-bold mb-3 font-playfair">Soutenir cette paroisse</h4>
                        <p class="text-gray-400 text-sm mb-6">Aidez-nous à entretenir ce lieu de culte et à soutenir nos œuvres.</p>
                        <a href="{{ route('donation') }}" class="text-kamina-gold font-bold hover:underline">Faire un don →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>