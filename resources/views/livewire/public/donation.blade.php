<div class="bg-gray-50 min-h-screen pb-16">
    
    <!-- Hero Header -->
    <div class="bg-kamina-blue text-white py-16 relative overflow-hidden">
        <!-- Motif de fond -->
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold font-playfair mb-4">Soutenir le Diocèse</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                "Que chacun donne comme il l'a résolu en son cœur, sans tristesse ni contrainte ; car Dieu aime celui qui donne avec joie." <br>
                <span class="text-kamina-gold text-sm font-bold mt-2 block">— 2 Corinthiens 9:7</span>
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Colonne Gauche : Pourquoi donner ? -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-md border-t-4 border-kamina-gold">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Pourquoi donner ?
                    </h3>
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex gap-3">
                            <span class="bg-blue-100 text-kamina-blue rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0 text-xs font-bold">1</span>
                            <span>Soutenir la formation des séminaristes et des prêtres.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="bg-blue-100 text-kamina-blue rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0 text-xs font-bold">2</span>
                            <span>Aider les œuvres caritatives (orphelinats, écoles, centres de santé).</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="bg-blue-100 text-kamina-blue rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0 text-xs font-bold">3</span>
                            <span>Entretenir les paroisses et construire de nouvelles églises.</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-kamina-blue p-6 rounded-2xl shadow-md text-white text-center">
                    <h3 class="font-bold text-lg mb-2">Besoin d'aide ?</h3>
                    <p class="text-blue-100 text-sm mb-4">Contactez l'économat diocésain pour toute question.</p>
                    <a href="tel:+243999000000" class="inline-block bg-white text-kamina-blue font-bold py-2 px-4 rounded-lg hover:bg-kamina-gold hover:text-white transition">
                        +243 999 000 000
                    </a>
                </div>
            </div>

            <!-- Colonne Droite : Moyens de Paiement -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden" x-data="{ activeTab: 'mobile' }">
                    
                    <!-- Onglets -->
                    <div class="flex border-b border-gray-100">
                        <button @click="activeTab = 'mobile'" 
                                :class="activeTab === 'mobile' ? 'border-b-2 border-kamina-blue text-kamina-blue bg-blue-50' : 'text-gray-500 hover:text-gray-700'"
                                class="flex-1 py-4 text-center font-bold text-sm sm:text-base transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Mobile Money
                        </button>
                        <button @click="activeTab = 'bank'" 
                                :class="activeTab === 'bank' ? 'border-b-2 border-kamina-blue text-kamina-blue bg-blue-50' : 'text-gray-500 hover:text-gray-700'"
                                class="flex-1 py-4 text-center font-bold text-sm sm:text-base transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            Virement Bancaire
                        </button>
                        <button @click="activeTab = 'cash'" 
                                :class="activeTab === 'cash' ? 'border-b-2 border-kamina-blue text-kamina-blue bg-blue-50' : 'text-gray-500 hover:text-gray-700'"
                                class="flex-1 py-4 text-center font-bold text-sm sm:text-base transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Sur Place
                        </button>
                    </div>

                    <!-- Contenu : Mobile Money -->
                    <div x-show="activeTab === 'mobile'" class="p-8 space-y-6 animate-fadeIn">
                        <p class="text-gray-600 mb-4">Envoyez votre don directement via votre téléphone aux numéros officiels du Diocèse.</p>
                        
                        <!-- Airtel -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-red-500 transition cursor-pointer bg-gray-50 hover:bg-white">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-red-600 text-white rounded-lg flex items-center justify-center font-bold text-xs">AIRTEL</div>
                                <div>
                                    <p class="font-bold text-gray-900">Airtel Money</p>
                                    <p class="text-sm text-gray-500">Nom : Diocèse Kamina</p>
                                </div>
                            </div>
                            <span class="text-lg font-mono font-bold text-gray-800 selection:bg-kamina-gold">+243 999 123 456</span>
                        </div>

                        <!-- M-Pesa -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-red-500 transition cursor-pointer bg-gray-50 hover:bg-white">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-red-600 text-white rounded-lg flex items-center justify-center font-bold text-xs">VODA</div>
                                <div>
                                    <p class="font-bold text-gray-900">M-Pesa</p>
                                    <p class="text-sm text-gray-500">Nom : Diocèse Kamina</p>
                                </div>
                            </div>
                            <span class="text-lg font-mono font-bold text-gray-800 selection:bg-kamina-gold">+243 812 345 678</span>
                        </div>

                        <!-- Orange -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-orange-500 transition cursor-pointer bg-gray-50 hover:bg-white">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-orange-500 text-white rounded-lg flex items-center justify-center font-bold text-xs">ORANGE</div>
                                <div>
                                    <p class="font-bold text-gray-900">Orange Money</p>
                                    <p class="text-sm text-gray-500">Nom : Diocèse Kamina</p>
                                </div>
                            </div>
                            <span class="text-lg font-mono font-bold text-gray-800 selection:bg-kamina-gold">+243 899 888 777</span>
                        </div>
                    </div>

                    <!-- Contenu : Banque -->
                    <div x-show="activeTab === 'bank'" class="p-8 space-y-6 animate-fadeIn" style="display: none;">
                        <p class="text-gray-600 mb-4">Pour les dons plus importants ou internationaux, privilégiez le virement bancaire.</p>
                        
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                            <h4 class="font-bold text-lg text-kamina-blue mb-4 border-b border-gray-200 pb-2">EQUITY BCDC</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-500 uppercase text-xs font-bold">Intitulé du compte</p>
                                    <p class="font-mono text-gray-900">DIOCESE DE KAMINA / CARITAS</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 uppercase text-xs font-bold">Code Swift</p>
                                    <p class="font-mono text-gray-900">EQTYCDK</p>
                                </div>
                                <div class="sm:col-span-2">
                                    <p class="text-gray-500 uppercase text-xs font-bold">Numéro de compte (USD)</p>
                                    <p class="font-mono text-xl font-bold text-gray-900 tracking-wider">0000-1234-5678-9012</p>
                                </div>
                                <div class="sm:col-span-2">
                                    <p class="text-gray-500 uppercase text-xs font-bold">Numéro de compte (CDF)</p>
                                    <p class="font-mono text-xl font-bold text-gray-900 tracking-wider">0000-9876-5432-1098</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenu : Sur Place -->
                    <div x-show="activeTab === 'cash'" class="p-8 text-center animate-fadeIn" style="display: none;">
                        <div class="inline-block p-4 bg-yellow-50 rounded-full mb-4">
                            <svg class="w-12 h-12 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Économat Diocésain</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Vous pouvez déposer vos dons directement au bureau de l'économat situé à l'Évêché. Un reçu vous sera délivré.
                        </p>
                        <div class="bg-gray-50 inline-block px-6 py-3 rounded-lg border border-gray-200">
                            <p class="font-bold text-gray-800">Avenue de la Mission, Kamina</p>
                            <p class="text-sm text-gray-500">Ouvert du Lundi au Vendredi (8h00 - 15h30)</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>