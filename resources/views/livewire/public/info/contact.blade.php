<div class="bg-gray-50 min-h-screen">
    
    <!-- En-tête -->
    <div class="bg-kamina-blue text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold font-playfair mb-4">Contactez-nous</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                Vous avez une question, une intention de prière ou besoin d'un renseignement administratif ? Le secrétariat de l'évêché est à votre écoute.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-16">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                
                <!-- Colonne Gauche : Infos -->
                <div class="bg-kamina-blue p-10 text-white relative overflow-hidden">
                    <!-- Motif de fond décoratif -->
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 opacity-10">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5 10 5 10-5-5-2.5-5 2.5z"/></svg>
                    </div>

                    <h3 class="text-2xl font-bold font-playfair mb-8 relative z-10">Nos Coordonnées</h3>
                    
                    <div class="space-y-8 relative z-10">
                        <div class="flex items-start gap-4">
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Adresse</h4>
                                <p class="text-blue-100 mt-1">Avenue de la Mission, <br>Kamina, Haut-Lomami <br>République Démocratique du Congo</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Téléphone</h4>
                                <p class="text-blue-100 mt-1">+243 999 000 000</p>
                                <p class="text-sm text-blue-200">Du Lundi au Vendredi, 8h - 16h</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-white/20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Email</h4>
                                <p class="text-blue-100 mt-1">contact@diocesekamina.org</p>
                                <p class="text-blue-100">secretariat@diocesekamina.org</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne Droite : Formulaire -->
                <div class="p-10 bg-white">
                    <h3 class="text-2xl font-bold font-playfair text-gray-800 mb-6">Envoyez-nous un message</h3>

                    <!-- Message Succès -->
                    @if (session()->has('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="submit" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Votre Nom</label>
                                <input wire:model="name" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-kamina-gold focus:border-transparent outline-none transition" placeholder="Jean Dupont">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Votre Email</label>
                                <input wire:model="email" type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-kamina-gold focus:border-transparent outline-none transition" placeholder="jean@exemple.com">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Sujet</label>
                            <input wire:model="subject" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-kamina-gold focus:border-transparent outline-none transition" placeholder="Demande de renseignement...">
                            @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Message</label>
                            <textarea wire:model="message" rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-kamina-gold focus:border-transparent outline-none transition" placeholder="Comment pouvons-nous vous aider ?"></textarea>
                            @error('message') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-kamina-gold hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition shadow-md hover:shadow-lg flex items-center justify-center gap-2 disabled:opacity-50" wire:loading.attr="disabled">
                            <span wire:loading.remove>Envoyer le message</span>
                            <span wire:loading>Envoi en cours...</span>
                            <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Carte (Google Maps Embed) -->
        <div class="mt-12 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4 pl-2 border-l-4 border-kamina-gold">Nous localiser</h3>
            <div class="w-full h-80 rounded-lg overflow-hidden bg-gray-200">
                <!-- Coordonnées approximatives de Kamina (à ajuster) -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62968.83167812973!2d24.990!3d-8.730!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19a64e0000000001%3A0x0!2sKamina!5e0!3m2!1sfr!2scd!4v1620000000000!5m2!1sfr!2scd" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>