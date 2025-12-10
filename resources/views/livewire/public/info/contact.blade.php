<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold font-playfair text-kamina-blue mb-4">Contactez-nous</h1>
            <p class="text-gray-600">Une question, une intention de prière ou une demande d'information ?</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- Informations -->
            <div class="bg-kamina-blue text-white rounded-2xl shadow-xl p-8 md:p-12 overflow-hidden relative">
                <!-- Décoration de fond -->
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-kamina-gold rounded-full opacity-20 blur-3xl"></div>
                
                <h3 class="text-2xl font-bold font-playfair mb-8">Nos Coordonnées</h3>
                
                <div class="space-y-8 relative z-10">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/10 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Adresse</h4>
                            <p class="text-blue-100">Avenue de la Mission<br>Kamina, Haut-Lomami<br>République Démocratique du Congo</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-white/10 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Email</h4>
                            <a href="mailto:contact@diocesekamina.org" class="text-blue-100 hover:text-white transition">contact@diocesekamina.org</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-white/10 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Téléphone</h4>
                            <p class="text-blue-100">+243 999 000 000</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
                <h3 class="text-2xl font-bold font-playfair text-gray-800 mb-6">Envoyer un message</h3>

                @if (session()->has('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="submit" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Votre Nom</label>
                            <input type="text" wire:model="name" class="w-full rounded-lg border-gray-300 focus:border-kamina-gold focus:ring-kamina-gold transition">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Votre Email</label>
                            <input type="email" wire:model="email" class="w-full rounded-lg border-gray-300 focus:border-kamina-gold focus:ring-kamina-gold transition">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sujet</label>
                        <input type="text" wire:model="subject" class="w-full rounded-lg border-gray-300 focus:border-kamina-gold focus:ring-kamina-gold transition">
                        @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                        <textarea wire:model="message" rows="5" class="w-full rounded-lg border-gray-300 focus:border-kamina-gold focus:ring-kamina-gold transition"></textarea>
                        @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-kamina-gold hover:bg-yellow-600 text-white font-bold py-3 rounded-lg shadow-md transition transform hover:-translate-y-0.5 flex justify-center items-center">
                        <span wire:loading.remove>Envoyer le message</span>
                        <span wire:loading><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>