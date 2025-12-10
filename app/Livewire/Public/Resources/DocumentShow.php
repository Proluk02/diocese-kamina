<?php

namespace App\Livewire\Public\Resources;

use App\Models\Document;
use Livewire\Component;

class DocumentShow extends Component
{
    public $document;

    public function mount($id)
    {
        $this->document = Document::findOrFail($id);
    }

    public function getYoutubeEmbedUrl($url)
    {
        // Même helper que dans l'admin pour afficher la vidéo
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