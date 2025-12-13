<div class="bg-brand-light dark:bg-gray-900 min-h-screen py-20 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Page -->
        <div class="relative mb-20 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 text-kamina-gold text-sm font-bold uppercase tracking-widest mb-6 bg-yellow-50 dark:bg-yellow-900/20 px-4 py-1 rounded-full">
                <span class="w-2 h-2 rounded-full bg-kamina-gold animate-ping"></span>
                Présence du Seigneur
            </div>
            
            <h1 class="text-5xl md:text-6xl font-bold font-playfair text-gray-900 dark:text-white mb-6">
                Nos <span class="text-transparent bg-clip-text bg-gradient-to-r from-kamina-blue to-blue-600">Paroisses</span>
            </h1>
            
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Trouvez une église, consultez les horaires des messes et rejoignez la communauté la plus proche de chez vous.
            </p>
        </div>

        <!-- Recherche & Filtres - Design Sticky Glass -->
        <div class="sticky top-24 z-40 mb-16 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md p-4 rounded-3xl shadow-xl shadow-black/5 border border-white/20 dark:border-gray-700/50 flex flex-col md:flex-row gap-4 max-w-4xl mx-auto" data-aos="zoom-in">
            <div class="flex-1 relative group">
                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-kamina-blue absolute left-4 top-3.5 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Rechercher une paroisse par nom..." class="w-full pl-11 pr-4 py-3 rounded-2xl border-none bg-gray-100/50 dark:bg-gray-800/50 focus:ring-2 focus:ring-kamina-gold text-gray-900 dark:text-white transition">
            </div>
            <div class="w-full md:w-64">
                <select wire:model.live="city" class="w-full py-3 px-4 rounded-2xl border-none bg-gray-100/50 dark:bg-gray-800/50 focus:ring-2 focus:ring-kamina-gold text-gray-900 dark:text-white transition">
                    <option value="">Toutes les villes</option>
                    @foreach($cities as $c) <option value="{{ $c }}">{{ $c }}</option> @endforeach
                </select>
            </div>
        </div>

        <!-- Grille des Paroisses -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($parishes as $index => $parish)
                <article class="group bg-white dark:bg-gray-800 rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700 flex flex-col h-full" 
                         data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    
                    <!-- Image -->
                    <div class="h-64 relative overflow-hidden">
                        @if($parish->photo_path)
                            <img src="{{ asset('storage/' . $parish->photo_path) }}" alt="{{ $parish->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center">
                                <span class="text-kamina-blue/20 dark:text-white/5 text-8xl font-bold">DK</span>
                            </div>
                        @endif
                        
                        <!-- Badge Ville -->
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-white/95 dark:bg-gray-900/90 backdrop-blur text-kamina-blue dark:text-blue-300 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                {{ $parish->city }}
                            </span>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-8 flex-1 flex flex-col relative">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-kamina-blue dark:group-hover:text-kamina-gold transition-colors leading-tight">
                            {{ $parish->name }}
                        </h3>
                        
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-6 flex items-start gap-2 leading-relaxed">
                            <svg class="w-5 h-5 mt-0.5 shrink-0 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ Str::limit($parish->address, 60) }}
                        </p>
                        
                        <div class="mt-auto pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <a href="{{ route('parishes.public.show', $parish->id) }}" class="text-sm font-bold text-kamina-blue dark:text-blue-400 group-hover:underline">
                                Voir les horaires →
                            </a>
                            <div class="h-10 w-10 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 group-hover:bg-kamina-gold group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-1 md:col-span-3 py-20 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Aucune paroisse ne correspond à votre recherche.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ $parishes->links() }}
        </div>
    </div>
</div>