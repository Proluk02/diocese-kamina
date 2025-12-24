<div class="bg-white dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <!-- Header -->
    <div class="bg-slate-50 dark:bg-gray-800/50 py-20 border-b border-slate-100 dark:border-gray-800">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <a href="{{ route('documents.public.index') }}" class="inline-flex items-center text-slate-400 hover:text-kamina-blue mb-8 transition-all font-bold text-xs uppercase tracking-widest group">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Retour aux documents
            </a>
            
            <div class="mb-6">
                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] bg-white dark:bg-gray-700 text-kamina-blue dark:text-blue-300 border border-slate-200 dark:border-gray-600 shadow-sm">
                    {{ $document->type }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-5xl font-black font-playfair text-slate-900 dark:text-white mb-6 leading-tight">
                {{ $document->title }}
            </h1>
            
            <div class="flex items-center justify-center gap-3 text-slate-400 text-sm font-bold uppercase tracking-tighter">
                <svg class="w-4 h-4 text-kamina-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"/></svg>
                Mis en ligne le {{ $document->created_at->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 -mt-10 relative z-10">
        <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-2xl p-8 md:p-14 border border-slate-100 dark:border-gray-700">
            
            <!-- Vidéo -->
            @if($document->video_link)
                <div class="mb-14 rounded-3xl overflow-hidden shadow-2xl bg-black aspect-video border border-gray-800">
                    @if($embedUrl = $this->getYoutubeEmbedUrl($document->video_link))
                        <iframe class="w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                    @else
                        <div class="h-full flex flex-col items-center justify-center p-10 text-center">
                            <a href="{{ $document->video_link }}" target="_blank" class="px-8 py-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-black transition-all">
                                REGARDER SUR YOUTUBE
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Description -->
            @if(!empty($document->description))
                <div class="prose prose-lg dark:prose-invert max-w-none text-slate-700 dark:text-gray-300 mb-14 font-serif leading-relaxed">
                    {!! $document->description !!}
                </div>
            @endif

            <!-- Téléchargement -->
            @if($document->file_path)
                <div class="bg-slate-50 dark:bg-gray-900/50 border-2 border-dashed border-slate-200 dark:border-gray-700 rounded-[2rem] p-8 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex items-center gap-6">
                        <div class="h-16 w-16 bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center text-red-500 shadow-sm border border-slate-100 dark:border-gray-700">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-width="2"/></svg>
                        </div>
                        <div class="text-center md:text-left">
                            <h4 class="font-black text-slate-900 dark:text-white text-xl uppercase tracking-tighter">Fichier PDF</h4>
                            <p class="text-sm text-slate-500 dark:text-gray-400 font-medium">Format haute qualité prêt à l'impression</p>
                        </div>
                    </div>
                    
                    @if($document->is_downloadable)
                        <button wire:click="download" wire:loading.attr="disabled" class="w-full md:w-auto flex items-center justify-center gap-3 px-10 py-5 bg-kamina-blue hover:bg-blue-800 text-white font-black rounded-2xl shadow-xl shadow-blue-500/20 transition-all hover:-translate-y-1 active:scale-95">
                            <svg wire:loading.remove wire:target="download" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5"/></svg>
                            <svg wire:loading wire:target="download" class="animate-spin h-6 w-6 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            TÉLÉCHARGER LE PDF
                        </button>
                    @else
                        <button class="px-10 py-5 bg-slate-200 dark:bg-gray-700 text-slate-500 dark:text-gray-400 font-black rounded-2xl cursor-not-allowed opacity-60">
                            LECTURE SEULE
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>