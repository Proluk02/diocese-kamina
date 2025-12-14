<footer class="bg-gray-900 text-white pt-20 pb-10 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            
            <!-- 1. Identité -->
            <div class="col-span-1 md:col-span-1 space-y-6">
                <a href="/" class="flex items-center gap-3">
                    <div class="h-12 w-12 bg-white text-kamina-blue rounded-xl flex items-center justify-center font-bold text-2xl shadow-lg shadow-blue-500/20">DK</div>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold font-playfair tracking-wider">DIOCÈSE</span>
                        <span class="text-[10px] text-gray-400 font-bold tracking-[0.25em] uppercase">de {{ $S['site_name'] ?? 'Kamina' }}</span>
                    </div>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Un diocèse vivant au cœur de la foi, engagé pour l'évangélisation et le service de la communauté.
                </p>
                <div class="flex space-x-4">
                    @if(!empty($S['facebook_url']))
                        <a href="{{ $S['facebook_url'] }}" target="_blank" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-kamina-blue hover:text-white transition-all"><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    @endif
                    @if(!empty($S['youtube_url']))
                        <a href="{{ $S['youtube_url'] }}" target="_blank" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-red-600 hover:text-white transition-all"><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
                    @endif
                </div>
            </div>

            <!-- 2. Liens -->
            <div>
                <h3 class="text-white font-bold mb-6 text-lg">Navigation</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" wire:navigate class="hover:text-kamina-gold transition">Accueil</a></li>
                    <li><a href="{{ route('news.index') }}" wire:navigate class="hover:text-kamina-gold transition">Actualités</a></li>
                    <li><a href="{{ route('parishes.public.index') }}" wire:navigate class="hover:text-kamina-gold transition">Paroisses</a></li>
                    <li><a href="{{ route('liturgy.public.index') }}" wire:navigate class="hover:text-kamina-gold transition">Liturgie</a></li>
                    <li><a href="{{ route('donation') }}" wire:navigate class="hover:text-kamina-gold transition">Faire un don</a></li>
                </ul>
            </div>

            <!-- 3. Ressources -->
            <div>
                <h3 class="text-white font-bold mb-6 text-lg">Ressources</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('documents.public.index') }}" wire:navigate class="hover:text-kamina-gold transition">Documents Officiels</a></li>
                    <li><a href="{{ route('presentation') }}" wire:navigate class="hover:text-kamina-gold transition">Qui sommes-nous ?</a></li>
                    <li><a href="{{ route('contact') }}" wire:navigate class="hover:text-kamina-gold transition">Contact</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-kamina-gold transition">Espace Prêtres</a></li>
                </ul>
            </div>

            <!-- 4. Contact Info Dynamique -->
            <div>
                <h3 class="text-white font-bold mb-6 text-lg">Contact</h3>
                <ul class="space-y-4 text-sm text-gray-400">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-kamina-gold mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="whitespace-pre-line">{{ $S['contact_address'] ?? 'Avenue de la Mission, Kamina' }}</span>
                    </li>
                    @if(!empty($S['contact_email']))
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-kamina-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:{{ $S['contact_email'] }}" class="hover:text-white transition">{{ $S['contact_email'] }}</a>
                    </li>
                    @endif
                    @if(!empty($S['contact_phone']))
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-kamina-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>{{ $S['contact_phone'] }}</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} Diocèse de {{ $S['site_name'] ?? 'Kamina' }}. Tous droits réservés.</p>
            <div class="mt-4 md:mt-0 space-x-6">
                <a href="#" class="hover:text-white transition">Mentions Légales</a>
                <a href="#" class="hover:text-white transition">Politique de Confidentialité</a>
            </div>
        </div>
    </div>
</footer>