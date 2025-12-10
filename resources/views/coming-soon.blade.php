<x-guest-layout>
    <div class="min-h-[60vh] flex flex-col items-center justify-center bg-gray-50 text-center px-4">
        <div class="bg-white p-8 rounded-2xl shadow-sm max-w-lg w-full">
            <div class="h-16 w-16 bg-blue-50 text-kamina-blue rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h1 class="text-3xl font-bold font-playfair text-gray-900 mb-2">{{ $title ?? 'Page en construction' }}</h1>
            <p class="text-gray-600 mb-8">Cette section est en cours de développement par l'équipe technique. Elle sera disponible très prochainement.</p>
            <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-kamina-blue text-white rounded-full hover:bg-blue-800 transition">
                Retour à l'accueil
            </a>
        </div>
    </div>
</x-guest-layout>