<div class="bg-brand-light dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <!-- HERO HEADER -->
    <div class="relative h-[50vh] min-h-[400px] flex items-center justify-center overflow-hidden bg-gray-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1544652478-6653e09f1826?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 class="w-full h-full object-cover opacity-40 transform scale-105"
                 alt="Contact">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" data-aos="fade-up">
            <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-kamina-gold text-sm font-bold tracking-widest mb-6 uppercase">
                Restons en lien
            </span>
            <h1 class="text-5xl md:text-7xl font-bold font-playfair text-white mb-6 leading-tight drop-shadow-2xl">
                Contactez-nous
            </h1>
            <p class="text-lg md:text-2xl text-gray-200 font-light max-w-2xl mx-auto leading-relaxed">
                Une question, une intention de prière ou une demande d'information ?
            </p>
        </div>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
            
            <!-- COORDONNÉES (Dynamiques) -->
            <div class="bg-gradient-to-br from-kamina-blue to-blue-900 text-white rounded-[2.5rem] shadow-2xl p-10 md:p-14 overflow-hidden relative" data-aos="fade-right">
                
                <h3 class="text-3xl font-bold font-playfair mb-10 relative z-10">Nos Coordonnées</h3>
                
                <div class="space-y-10 relative z-10">
                    <!-- Adresse -->
                    <div class="flex items-start gap-6 group">
                        <div class="h-14 w-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:bg-kamina-gold group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7 text-kamina-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Siège Diocésain</h4>
                            <p class="text-blue-100 font-light leading-relaxed whitespace-pre-line">
                                {{ $S['contact_address'] ?? 'Adresse non définie' }}
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-6 group">
                        <div class="h-14 w-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:bg-kamina-gold group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7 text-kamina-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Email</h4>
                            <a href="mailto:{{ $S['contact_email'] ?? '' }}" class="text-blue-100 hover:text-white hover:underline transition font-light block">
                                {{ $S['contact_email'] ?? '' }}
                            </a>
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div class="flex items-start gap-6 group">
                        <div class="h-14 w-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:bg-kamina-gold group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7 text-kamina-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Téléphone</h4>
                            <p class="text-blue-100 font-light font-mono">{{ $S['contact_phone'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLONNE DROITE : FORMULAIRE -->
            <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl border border-gray-100 dark:border-gray-700 p-8 md:p-12" data-aos="fade-up">
                <h3 class="text-3xl font-bold font-playfair text-gray-900 dark:text-white mb-8">Envoyer un message</h3>

                @if (session()->has('success'))
                    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 text-green-700 dark:text-green-300 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="submit" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Nom</label>
                            <input type="text" wire:model="name" class="w-full rounded-xl border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-kamina-gold focus:ring-kamina-gold transition p-3.5">
                            @error('name') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Email</label>
                            <input type="email" wire:model="email" class="w-full rounded-xl border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-kamina-gold focus:ring-kamina-gold transition p-3.5">
                            @error('email') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Sujet</label>
                        <input type="text" wire:model="subject" class="w-full rounded-xl border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-kamina-gold focus:ring-kamina-gold transition p-3.5">
                        @error('subject') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Message</label>
                        <textarea wire:model="message" rows="5" class="w-full rounded-xl border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900/50 text-gray-900 dark:text-white focus:border-kamina-gold focus:ring-kamina-gold transition p-3.5"></textarea>
                        @error('message') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-kamina-gold hover:bg-yellow-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>