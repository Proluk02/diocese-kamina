<?php

namespace App\Livewire\Public\Resources;

use Livewire\Component;
use App\Models\Document;

class DocumentShow extends Component
{
    public $document;

    public function mount($id)
    {
        $this->document = Document::findOrFail($id);
    }

    public function getYoutubeEmbedUrl($url)
    {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        return null;
    }

    public function render()
    {
        return view('livewire.public.resources.document-show')->layout('layouts.guest');
    }
}