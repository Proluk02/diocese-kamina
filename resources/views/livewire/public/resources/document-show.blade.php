<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <a href="{{ route('documents.public.index') }}" class="inline-flex items-center text-gray-500 hover:text-kamina-blue mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour aux documents
        </a>

        <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12">
            <!-- Header -->
            <div class="border-b border-gray-100 pb-6 mb-8 text-center">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-kamina-blue/10 text-kamina-blue mb-3">
                    {{ $document->type }}
                </span>
                <h1 class="text-3xl md:text-4xl font-bold font-playfair text-gray-900 mb-4">{{ $document->title }}</h1>
                <div class="text-gray-500 text-sm">Publié le {{ $document->created_at->format('d F Y') }}</div>
            </div>

            <!-- Vidéo -->
            @if($document->video_link)
                <div class="mb-10 rounded-xl overflow-hidden shadow-lg bg-black">
                    @if($embedUrl = $this->getYoutubeEmbedUrl($document->video_link))
                        <div class="relative w-full" style="padding-bottom: 56.25%;">
                            <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="p-12 text-center text-white">
                            <p class="mb-4">Vidéo disponible sur une plateforme externe.</p>
                            <a href="{{ $document->video_link }}" target="_blank" class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 rounded-lg text-white font-bold">Voir la vidéo</a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Contenu Texte -->
            @if(!empty($document->description))
                <div class="prose prose-lg max-w-none text-gray-700 mb-10 prose-headings:font-playfair prose-a:text-kamina-blue">
                    {!! $document->description !!}
                </div>
            @endif

            <!-- Téléchargement -->
            @if($document->file_path)
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 bg-white rounded-lg flex items-center justify-center text-red-500 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Document PDF joint</h4>
                            <p class="text-sm text-blue-600">{{ $document->is_downloadable ? 'Disponible au téléchargement' : 'Lecture seule' }}</p>
                        </div>
                    </div>
                    
                    @if($document->is_downloadable)
                        <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" class="px-6 py-3 bg-kamina-blue hover:bg-blue-800 text-white font-bold rounded-lg shadow transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Télécharger
                        </a>
                    @else
                        <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold rounded-lg transition">
                            Lire en ligne
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>