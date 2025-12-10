<div class="bg-white min-h-screen pb-20">
    
    <!-- Header avec Image de fond floutée -->
    <div class="relative h-96 w-full bg-gray-900 overflow-hidden">
        @if($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full h-full object-cover opacity-50 blur-sm scale-110">
            <img src="{{ asset('storage/' . $post->image_path) }}" class="absolute inset-0 w-full h-full object-contain z-10 shadow-xl">
        @else
            <div class="w-full h-full flex items-center justify-center opacity-30">
                <span class="text-white text-6xl font-bold">DK</span>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-20"></div>
        <div class="absolute bottom-0 left-0 w-full p-4 z-30">
            <div class="max-w-4xl mx-auto">
                <span class="bg-kamina-gold text-white px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wider mb-4 inline-block">
                    {{ $post->category->name }}
                </span>
                <h1 class="text-3xl md:text-5xl font-bold text-white font-playfair leading-tight mb-4 drop-shadow-md">
                    {{ $post->title }}
                </h1>
                <div class="flex items-center gap-6 text-gray-300 text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ $post->user->name }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $post->created_at->translatedFormat('d F Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-40">
        <!-- Contenu Article -->
        <article class="bg-white rounded-xl shadow-lg p-8 md:p-12 prose prose-lg max-w-none prose-headings:font-playfair prose-headings:text-kamina-blue prose-a:text-kamina-gold">
            <!-- Injection du contenu Quill -->
            {!! $post->body !!}
        </article>

        <!-- Partage & Navigation -->
        <div class="mt-12 border-t border-gray-100 pt-8 flex justify-between items-center">
            <a href="{{ route('news.index') }}" class="text-gray-500 hover:text-kamina-blue font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour aux actualités
            </a>
            <div class="flex gap-2">
                <button class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></button>
                <button class="bg-green-500 text-white p-2 rounded-full hover:bg-green-600 transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></button>
            </div>
        </div>

        <!-- Articles Similaires -->
        @if($relatedPosts->count() > 0)
        <div class="mt-16">
            <h3 class="text-2xl font-bold font-playfair text-gray-800 mb-6">Dans la même catégorie</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                    <a href="{{ route('news.show', $related->slug) }}" class="group bg-white border border-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                        <div class="h-40 overflow-hidden">
                            @if($related->image_path)
                                <img src="{{ asset('storage/' . $related->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300"><svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 line-clamp-2 group-hover:text-kamina-blue">{{ $related->title }}</h4>
                            <span class="text-xs text-gray-500 mt-2 block">{{ $related->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>