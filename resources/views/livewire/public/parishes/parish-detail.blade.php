<div class="bg-gray-50 min-h-screen pb-12">
    
    <!-- Hero Header (Image de fond) -->
    <div class="relative bg-kamina-blue h-64 md:h-80 w-full overflow-hidden">
        @if($parish->photo_path)
            <img class="w-full h-full object-cover opacity-40 mix-blend-overlay" src="{{ asset('storage/'.$parish->photo_path) }}" alt="{{ $parish->name }}">
        @else
            <div class="w-full h-full bg-gradient-to-r from-kamina-blue to-blue-900 opacity-50"></div>
        @endif
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm text-sm font-semibold tracking-wider mb-2 uppercase">{{ $parish->city }}</span>
                <h1 class="text-3xl md:text-5xl font-bold font-playfair shadow-black drop-shadow-md">{{ $parish->name }}</h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLONNE GAUCHE : Infos Pratiques (Sticky) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 space-y-8 sticky top-24">
                    
                    <!-- Adresse -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Coordonnées</h3>
                        <div class="flex items-start gap-3 text-gray-600 mb-3">
                            <svg class="w-5 h-5 text-kamina-gold mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <p>{{ $parish->address }}<br>{{ $parish->city }}</p>
                        </div>
                        @if($parish->contact_phone)
                        <div class="flex items-center gap-3 text-gray-600">
                            <svg class="w-5 h-5 text-kamina-gold flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            <p>{{ $parish->contact_phone }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="border-t border-gray-100"></div>

                    <!-- Horaires des Messes -->
                    <div>
                        <h3 class="flex items-center gap-2 text-lg font-bold text-kamina-blue mb-4">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Horaires des Messes
                        </h3>
                        <!-- Affichage du HTML Rich Text -->
                        <div class="prose prose-sm prose-blue text-gray-600">
                            @if(!empty($parish->mass_schedules))
                                {!! $parish->mass_schedules !!}
                            @else
                                <p class="italic text-gray-400">Horaires non disponibles pour le moment.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Bouton Itinéraire (Faux lien Google Maps) -->
                    <div class="pt-2">
                        <a href="https://maps.google.com/?q={{ urlencode($parish->name . ' ' . $parish->city) }}" target="_blank" class="block w-full text-center bg-kamina-gold text-white font-bold py-3 rounded-lg shadow hover:bg-yellow-600 transition">
                            Y aller
                        </a>
                    </div>

                </div>
            </div>

            <!-- COLONNE DROITE : Contenu & Clergé -->
            <div class="lg:col-span-2 space-y-8 mt-4 lg:mt-0">
                
                <!-- Histoire -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-2xl font-bold font-playfair text-gray-800 mb-6 border-b-2 border-kamina-gold/20 pb-2 inline-block">Histoire & Présentation</h2>
                    <div class="prose prose-lg text-gray-600 max-w-none">
                        @if(!empty($parish->history))
                            {!! $parish->history !!}
                        @else
                            <p class="italic text-gray-400">L'histoire de cette paroisse sera bientôt ajoutée.</p>
                        @endif
                    </div>
                </div>

                <!-- Équipe Pastorale (Clergé) -->
                @php
                    $clergies = $parish->users->whereIn('role', ['priest', 'secretary']);
                @endphp

                @if($clergies->isNotEmpty())
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h3 class="text-xl font-bold font-playfair text-gray-800 mb-6">Au service de la paroisse</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($clergies as $member)
                            <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition">
                                <div class="h-12 w-12 rounded-full bg-kamina-blue/10 text-kamina-blue flex items-center justify-center font-bold text-lg">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $member->name }}</p>
                                    <p class="text-sm text-kamina-gold">
                                        {{ $member->role === 'priest' ? 'Curé / Prêtre' : 'Secrétariat' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>