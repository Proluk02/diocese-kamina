<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <a href="{{ route('documents.public.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-kamina-blue mb-6 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour aux documents
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gray-100 text-gray-600 mb-4">
                    {{ ucfirst($document->type) }}
                </span>
                
                <h1 class="text-3xl font-bold font-playfair text-gray-900 mb-4">{{ $document->title }}</h1>
                
                <div class="flex items-center text-sm text-gray-500 mb-8 pb-8 border-b border-gray-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Publié le {{ $document->created_at->format('d/m/Y') }}
                </div>

                <!-- Vidéo -->
                @if($document->video_link)
                    <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                        @if($embed = $this->getYoutubeEmbedUrl($document->video_link))
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="{{ $embed }}" class="w-full h-[400px]" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @else
                            <a href="{{ $document->video_link }}" target="_blank" class="block p-6 bg-gray-900 text-white text-center hover:bg-gray-800 transition">
                                Voir la vidéo externe
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Contenu -->
                <div class="prose prose-blue max-w-none text-gray-700">
                    {!! $document->description !!}
                </div>

                <!-- Téléchargement -->
                @if($document->file_path && $document->is_downloadable)
                    <div class="mt-12 pt-8 border-t border-gray-100 flex justify-center">
                        <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-kamina-blue text-white font-bold rounded-lg shadow hover:bg-blue-800 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Télécharger le document PDF
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>