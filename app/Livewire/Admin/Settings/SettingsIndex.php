<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads; // Important
use Illuminate\Support\Facades\Storage;

class SettingsIndex extends Component
{
    use WithFileUploads;

    public $site_name;
    public $contact_email;
    public $contact_phone;
    public $contact_address;
    public $facebook_url;
    public $youtube_url;

    // Gestion du Carrousel
    public $slides = []; // Images existantes (chemins)
    public $newSlide;    // Nouvelle image temporaire

    public function mount()
    {
        $settings = Setting::all()->pluck('value', 'key');

        $this->site_name = $settings['site_name'] ?? 'Diocèse de Kamina';
        $this->contact_email = $settings['contact_email'] ?? '';
        $this->contact_phone = $settings['contact_phone'] ?? '';
        $this->contact_address = $settings['contact_address'] ?? '';
        $this->facebook_url = $settings['facebook_url'] ?? '';
        $this->youtube_url = $settings['youtube_url'] ?? '';

        // Récupérer les slides (JSON decode)
        $this->slides = json_decode($settings['home_slides'] ?? '[]', true);
    }

    public function addSlide()
    {
        $this->validate([
            'newSlide' => 'image|max:2048', // 2MB max
        ]);

        // Sauvegarder l'image
        $path = $this->newSlide->store('slides', 'public');
        
        // Ajouter au tableau
        $this->slides[] = $path;
        
        // Mettre à jour la BDD immédiatement
        Setting::updateOrCreate(['key' => 'home_slides'], ['value' => json_encode($this->slides)]);
        
        // Reset champ
        $this->newSlide = null;
        session()->flash('success', 'Image ajoutée au carrousel.');
    }

    public function removeSlide($index)
    {
        // Supprimer le fichier physique
        if (isset($this->slides[$index])) {
            Storage::disk('public')->delete($this->slides[$index]);
        }

        // Retirer du tableau
        unset($this->slides[$index]);
        $this->slides = array_values($this->slides); // Réindexer

        // Mettre à jour la BDD
        Setting::updateOrCreate(['key' => 'home_slides'], ['value' => json_encode($this->slides)]);
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
        ]);

        $data = [
            'site_name' => $this->site_name,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'contact_address' => $this->contact_address,
            'facebook_url' => $this->facebook_url,
            'youtube_url' => $this->youtube_url,
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        session()->flash('success', 'Paramètres généraux mis à jour.');
    }

    public function render()
    {
        return view('livewire.admin.settings.settings-index')->layout('layouts.app');
    }
}