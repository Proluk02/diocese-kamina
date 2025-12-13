<div class="bg-white dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <!-- Header Simple & Élégant -->
    <div class="bg-brand-light dark:bg-gray-800 py-16 border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <a href="{{ route('documents.public.index') }}" class="inline-flex items-center text-gray-500 dark:text-gray-400 hover:text-kamina-blue dark:hover:text-blue-400 mb-8 transition-colors text-sm font-bold uppercase tracking-widest">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour à la liste
            </a>
            
            <div class="mb-6">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white dark:bg-gray-700 text-kamina-blue dark:text-blue-300 shadow-sm border border-gray-200 dark:border-gray-600">
                    {{ $document->type }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-5xl font-bold font-playfair text-gray-900 dark:text-white mb-6 leading-tight">
                {{ $document->title }}
            </h1>
            
            <div class="flex items-center justify-center gap-2 text-gray-500 dark:text-gray-400 text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Publié le {{ $document->created_at->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100 dark:border-gray-700">
            
            <!-- Vidéo -->
            @if($document->video_link)
                <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl bg-black border border-gray-800">
                    @if($embedUrl = $this->getYoutubeEmbedUrl($document->video_link))
                        <div class="relative w-full" style="padding-bottom: 56.25%;">
                            <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="p-16 text-center">
                            <div class="h-16 w-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white shadow-lg shadow-red-500/30 animate-pulse">
                                <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Vidéo Externe</h3>
                            <p class="text-gray-400 mb-6">Cette vidéo est hébergée sur une autre plateforme.</p>
                            <a href="{{ $document->video_link }}" target="_blank" class="inline-flex items-center px-8 py-3 bg-white text-gray-900 hover:bg-gray-100 rounded-full font-bold transition">
                                Regarder la vidéo
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Contenu Texte -->
            @if(!empty($document->description))
                <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 mb-12 font-serif leading-relaxed">
                    {!! $document->description !!}
                </div>
            @endif

            <!-- Zone de Téléchargement -->
            @if($document->file_path)
                <div class="bg-brand-light dark:bg-gray-900/50 border border-blue-100 dark:border-gray-700 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6 transition hover:border-kamina-blue/30 dark:hover:border-blue-800">
                    <div class="flex items-center gap-5">
                        <div class="h-14 w-14 bg-white dark:bg-gray-800 rounded-xl flex items-center justify-center text-red-500 shadow-md border border-gray-100 dark:border-gray-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white text-lg">Document PDF joint</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $document->is_downloadable ? 'Disponible au téléchargement' : 'Lecture en ligne uniquement' }}
                            </p>
                        </div>
                    </div>
                    
                    @if($document->is_downloadable)
                        <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" class="group flex items-center gap-2 px-8 py-3 bg-kamina-blue hover:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 transition-all hover:-translate-y-0.5">
                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Télécharger
                        </a>
                    @else
                        <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" class="px-8 py-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 font-bold rounded-xl transition">
                            Lire en ligne
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>