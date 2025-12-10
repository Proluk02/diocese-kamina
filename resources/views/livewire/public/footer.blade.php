<footer class="bg-kamina-blue text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            
            <!-- Colonne 1 : Identité -->
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <div class="h-10 w-10 bg-white text-kamina-blue rounded-lg flex items-center justify-center font-bold text-xl">DK</div>
                    <span class="text-xl font-bold font-playfair tracking-wide">DIOCÈSE DE KAMINA</span>
                </div>
                <p class="text-blue-100 text-sm leading-relaxed">
                    Un diocèse vivant au cœur de la foi, engagé pour l'évangélisation et le service de la communauté.
                </p>
                <div class="flex space-x-4 pt-2">
                    <a href="#" class="text-blue-200 hover:text-white transition"><span class="sr-only">Facebook</span><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                    <a href="#" class="text-blue-200 hover:text-white transition"><span class="sr-only">YouTube</span><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
                </div>
            </div>

            <!-- Colonne 2 : Liens Rapides -->

            <!-- Colonne 2 : Liens Rapides -->
            <div>
                <h3 class="text-lg font-bold mb-4 text-kamina-gold">Accès Rapide</h3>
                <ul class="space-y-2 text-sm text-blue-100">
                    <li><a href="{{ route('parishes.public.index') }}" class="hover:text-white hover:underline">Horaires des Messes</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white hover:underline">Dernières Actualités</a></li>
                    <li><a href="{{ route('documents.public.index') }}" class="hover:text-white hover:underline">Documents Officiels</a></li>
                    <li><a href="{{ route('liturgy.public.index') }}" class="hover:text-white hover:underline">Chants Liturgiques</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white hover:underline">Contacter l'Évêché</a></li>
                </ul>
            </div>

            <!-- Colonne 3 : Contact -->
            <div>
                <h3 class="text-lg font-bold mb-4 text-kamina-gold">Nous Contacter</h3>
                <ul class="space-y-4 text-sm text-blue-100">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-kamina-gold mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Avenue de la Mission, <br>Kamina, Haut-Lomami, RDC</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:contact@diocesekamina.org" class="hover:text-white">contact@diocesekamina.org</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>+243 999 000 000</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-blue-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-blue-300">
            <p>&copy; {{ date('Y') }} Diocèse de Kamina. Tous droits réservés.</p>
            <div class="mt-2 md:mt-0 space-x-4">
                <a href="#" class="hover:text-white">Mentions Légales</a>
                <a href="#" class="hover:text-white">Confidentialité</a>
            </div>
        </div>
    </div>
</footer>