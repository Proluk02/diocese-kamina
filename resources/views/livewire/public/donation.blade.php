<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold font-playfair text-kamina-blue mb-4">Soutenir le Diocèse</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Votre générosité nous permet de continuer notre mission d'évangélisation, de soutenir nos prêtres et d'aider les plus démunis.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Colonne Gauche : Pourquoi donner ? -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Carte Projets -->
                <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg text-kamina-blue">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        À quoi servira votre don ?
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex gap-4">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold shrink-0"></div>
                            <p class="text-gray-600"><strong>Construction & Rénovation</strong> des paroisses et structures diocésaines.</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold shrink-0"></div>
                            <p class="text-gray-600"><strong>Formation des Séminaristes</strong>, les futurs prêtres de demain.</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold shrink-0"></div>
                            <p class="text-gray-600"><strong>Œuvres Caritatives</strong> et soutien aux orphelinats locaux.</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold shrink-0"></div>
                            <p class="text-gray-600"><strong>Soutien aux Prêtres</strong> âgés ou malades.</p>
                        </div>
                    </div>
                </div>

                <!-- Intention de messe (Formulaire simple) -->
                <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Demander une intention de messe</h3>
                    <p class="text-gray-500 text-sm mb-6">Vous pouvez faire une offrande pour qu'une messe soit célébrée à vos intentions.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center text-kamina-blue font-semibold hover:underline">
                        Contactez le secrétariat pour une intention
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Colonne Droite : Moyens de paiement -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Mobile Money -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-kamina-gold relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-kamina-gold opacity-10 rounded-full"></div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Mobile Money</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <span class="font-bold text-red-600">Airtel Money</span>
                            <span class="font-mono text-gray-700 select-all">099 000 0000</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <span class="font-bold text-orange-500">Orange Money</span>
                            <span class="font-mono text-gray-700 select-all">080 000 0000</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                            <span class="font-bold text-red-500">M-Pesa</span>
                            <span class="font-mono text-gray-700 select-all">081 000 0000</span>
                        </div>
                    </div>
                </div>

                <!-- Banque -->
                <div class="bg-kamina-blue text-white rounded-2xl shadow-lg p-6 relative overflow-hidden">
                    <div class="absolute bottom-0 right-0 -mb-6 -mr-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Virement Bancaire
                    </h3>
                    
                    <div class="space-y-4 text-sm">
                        <div>
                            <p class="text-blue-200 text-xs uppercase tracking-wider">Banque</p>
                            <p class="font-semibold text-lg">EQUITY BCDC</p>
                        </div>
                        <div>
                            <p class="text-blue-200 text-xs uppercase tracking-wider">Intitulé du compte</p>
                            <p class="font-medium">Diocèse de Kamina</p>
                        </div>
                        <div>
                            <p class="text-blue-200 text-xs uppercase tracking-wider">Numéro de compte (USD)</p>
                            <p class="font-mono text-lg tracking-wider select-all">0000-1234-5678-90</p>
                        </div>
                        <div>
                            <p class="text-blue-200 text-xs uppercase tracking-wider">Code Swift</p>
                            <p class="font-mono select-all">EQTYCDKI</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>