<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // <--- Import nécessaire
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function downloadSong($id, $type)
    {
        $song = Song::findOrFail($id);
        
        // Déterminer le fichier à télécharger
        $path = match($type) {
            'audio' => $song->audio_path,
            'score' => $song->score_path,
            default => null,
        };

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'Fichier introuvable.');
        }

        // Nettoyer le nom du fichier pour le téléchargement
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $cleanTitle = Str::slug($song->title);
        
        $suffix = $type === 'score' ? '-partition' : '-audio';
        $filename = "{$cleanTitle}{$suffix}.{$extension}";

        // Forcer le téléchargement
        return Storage::disk('public')->download($path, $filename);
    }
}