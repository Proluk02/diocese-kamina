<div class="bg-brand-light dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <!-- ========================================================= -->
    <!-- HERO HEADER -->
    <!-- ========================================================= -->
    <div class="relative h-[50vh] min-h-[400px] flex items-center justify-center overflow-hidden bg-kamina-blue">
        <!-- Fond avec pattern -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-kamina-blue via-blue-900 to-gray-900 opacity-90"></div>
        
        <!-- Décorations -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-kamina-gold/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -ml-20 -mb-20"></div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" data-aos="fade-up">
            <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-kamina-gold text-sm font-bold tracking-widest mb-6 uppercase">
                Générosité
            </span>
            <h1 class="text-5xl md:text-7xl font-bold font-playfair text-white mb-6 leading-tight drop-shadow-2xl">
                Soutenir la Mission
            </h1>
            <p class="text-lg md:text-2xl text-blue-100 font-light max-w-2xl mx-auto leading-relaxed">
                Votre don permet à l'Église de poursuivre son œuvre d'évangélisation et de charité.
            </p>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- CONTENU PRINCIPAL -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLONNE GAUCHE : IMPACT -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Carte "À quoi ça sert" -->
                <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl p-8 md:p-12 border border-gray-100 dark:border-gray-700 relative overflow-hidden" 
                     data-aos="fade-up">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-4 font-playfair">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-2xl text-kamina-blue dark:text-blue-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        L'impact de votre don
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="flex gap-4 items-start group">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold group-hover:scale-150 transition-transform"></div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><strong>Bâtir l'Église</strong> : Construction et rénovation des paroisses, chapelles et presbytères.</p>
                        </div>
                        <div class="flex gap-4 items-start group">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold group-hover:scale-150 transition-transform"></div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><strong>Former les Prêtres</strong> : Soutien aux séminaristes, les futurs pasteurs de demain.</p>
                        </div>
                        <div class="flex gap-4 items-start group">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold group-hover:scale-150 transition-transform"></div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><strong>Charité</strong> : Aide aux orphelinats, écoles et centres de santé diocésains.</p>
                        </div>
                        <div class="flex gap-4 items-start group">
                            <div class="w-2 h-2 mt-2 rounded-full bg-kamina-gold group-hover:scale-150 transition-transform"></div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><strong>Solidarité</strong> : Prise en charge des prêtres âgés ou malades.</p>
                        </div>
                    </div>
                </div>

                <!-- Intention de Messe -->
                <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-[2.5rem] shadow-sm border border-gray-200 dark:border-gray-700 p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-6"
                     data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Offrir une Messe</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Faites célébrer une messe à vos intentions particulières.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="group flex items-center gap-2 px-6 py-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-full text-kamina-blue dark:text-white font-bold hover:shadow-lg transition-all hover:-translate-y-1">
                        Contacter le secrétariat
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- COLONNE DROITE : MOYENS DE PAIEMENT -->
            <div class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="200">
                
                <!-- Mobile Money -->
                <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl p-8 border-t-8 border-kamina-gold relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-kamina-gold/10 rounded-full"></div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 font-playfair">Mobile Money</h3>
                    
                    <div class="space-y-4">
                        <!-- Airtel -->
                        <div class="flex items-center justify-between p-4 bg-red-50 dark:bg-red-900/10 rounded-2xl border border-red-100 dark:border-red-900/30">
                            <span class="font-bold text-red-600 dark:text-red-400 text-sm">Airtel Money</span>
                            <span class="font-mono text-gray-800 dark:text-gray-200 font-bold select-all cursor-pointer hover:text-red-600" title="Copier">099 000 0000</span>
                        </div>
                        <!-- Orange -->
                        <div class="flex items-center justify-between p-4 bg-orange-50 dark:bg-orange-900/10 rounded-2xl border border-orange-100 dark:border-orange-900/30">
                            <span class="font-bold text-orange-600 dark:text-orange-400 text-sm">Orange Money</span>
                            <span class="font-mono text-gray-800 dark:text-gray-200 font-bold select-all cursor-pointer hover:text-orange-600" title="Copier">080 000 0000</span>
                        </div>
                        <!-- M-Pesa -->
                        <div class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-900/10 rounded-2xl border border-green-100 dark:border-green-900/30">
                            <span class="font-bold text-green-600 dark:text-green-400 text-sm">M-Pesa</span>
                            <span class="font-mono text-gray-800 dark:text-gray-200 font-bold select-all cursor-pointer hover:text-green-600" title="Copier">081 000 0000</span>
                        </div>
                    </div>
                </div>

                <!-- Virement Bancaire -->
                <div class="bg-gradient-to-br from-kamina-blue to-blue-900 text-white rounded-[2.5rem] shadow-xl p-8 relative overflow-hidden group">
                    <!-- Déco -->
                    <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-40 h-40 bg-white/5 rounded-full group-hover:scale-110 transition-transform duration-700"></div>
                    
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-3 font-playfair">
                        <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        Virement Bancaire
                    </h3>
                    
                    <div class="space-y-5 text-sm relative z-10">
                        <div>
                            <p class="text-blue-300 text-[10px] font-bold uppercase tracking-wider mb-1">Banque</p>
                            <p class="font-bold text-lg">EQUITY BCDC</p>
                        </div>
                        <div>
                            <p class="text-blue-300 text-[10px] font-bold uppercase tracking-wider mb-1">Bénéficiaire</p>
                            <p class="font-medium">Diocèse de Kamina</p>
                        </div>
                        <div class="bg-white/10 p-4 rounded-xl border border-white/10">
                            <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-1">Numéro de Compte (USD)</p>
                            <p class="font-mono text-xl tracking-widest font-bold select-all">0000-1234-5678</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-300 text-xs font-bold uppercase">Code Swift</span>
                            <span class="font-mono font-bold select-all bg-black/20 px-2 py-1 rounded">EQTYCDKI</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>