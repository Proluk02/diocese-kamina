<div class="bg-white min-h-screen pb-20">
    
    <!-- Hero Image -->
    <div class="relative h-[400px] w-full bg-gray-900 overflow-hidden">
        @if($parish->photo_path)
            <img src="{{ asset('storage/' . $parish->photo_path) }}" class="w-full h-full object-cover opacity-60">
        @else
            <div class="w-full h-full flex items-center justify-center opacity-30">
                <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-12 z-10">
            <div class="max-w-7xl mx-auto">
                <span class="bg-kamina-gold text-white px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wider mb-4 inline-block shadow-lg">
                    {{ $parish->city }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white font-playfair leading-tight mb-2">
                    {{ $parish->name }}
                </h1>
                <p class="text-gray-300 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $parish->address }}
                </p>
            </div>
        </div>
    </div>

    <!-- Contenu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Colonne Gauche : Horaires & Contact -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Horaires -->
                <div class="bg-blue-50 rounded-2xl p-8 border border-blue-100 shadow-sm sticky top-24">
                    <h3 class="text-2xl font-bold text-kamina-blue font-playfair mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Messes
                    </h3>
                    
                    @if(!empty($parish->mass_schedules))
                        <div class="prose prose-blue prose-sm text-gray-700">
                            {!! $parish->mass_schedules !!}
                        </div>
                    @else
                        <p class="text-gray-500 italic">Horaires non disponibles pour le moment.</p>
                    @endif

                    <div class="border-t border-blue-200 my-6"></div>

                    <h4 class="font-bold text-gray-900 mb-2">Contact</h4>
                    <p class="text-gray-600 text-sm mb-4">{{ $parish->contact_phone ?? 'Non renseigné' }}</p>
                    
                    <a href="{{ route('contact') }}" class="block w-full text-center px-4 py-2 bg-white border border-blue-200 text-kamina-blue font-semibold rounded-lg hover:bg-kamina-blue hover:text-white transition">
                        Contacter le secrétariat
                    </a>
                </div>
            </div>

            <!-- Colonne Droite : Histoire & Clergé -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Histoire -->
                <section>
                    <h2 class="text-3xl font-bold text-gray-900 font-playfair mb-6 border-l-4 border-kamina-gold pl-4">Histoire de la Paroisse</h2>
                    @if(!empty($parish->history))
                        <div class="prose prose-lg text-gray-600 max-w-none text-justify">
                            {!! $parish->history !!}
                        </div>
                    @else
                        <p class="text-gray-500 italic">L'histoire de cette paroisse sera bientôt ajoutée.</p>
                    @endif
                </section>

                <!-- Clergé (Prêtres liés) -->
                @if($parish->users->whereIn('role', ['priest', 'bishop'])->count() > 0)
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 font-playfair mb-6">Clergé</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($parish->users->whereIn('role', ['priest', 'bishop']) as $priest)
                            <div class="flex items-center gap-4 p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition">
                                <div class="h-12 w-12 rounded-full bg-kamina-blue text-white flex items-center justify-center font-bold text-lg">
                                    {{ substr($priest->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $priest->name }}</h4>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">
                                        {{ $priest->role === 'bishop' ? 'Évêque' : 'Prêtre' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif

            </div>
        </div>
    </div>
</div>