<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
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

    // Présentation (Nouveau)
    public $history_text;
    public $mission_text;
    public $bishop_name;
    public $bishop_bio;

    // Gestion du Carrousel
    public $slides = []; 
    public $newSlide;    

    public function mount()
    {
        $settings = Setting::all()->pluck('value', 'key');

        $this->site_name = $settings['site_name'] ?? 'Diocèse de Kamina';
        $this->contact_email = $settings['contact_email'] ?? '';
        $this->contact_phone = $settings['contact_phone'] ?? '';
        $this->contact_address = $settings['contact_address'] ?? '';
        $this->facebook_url = $settings['facebook_url'] ?? '';
        $this->youtube_url = $settings['youtube_url'] ?? '';
        
        // Contenu Présentation
        $this->history_text = $settings['history_text'] ?? '';
        $this->mission_text = $settings['mission_text'] ?? '';
        $this->bishop_name = $settings['bishop_name'] ?? 'Mgr Léonard KAKUDJI';
        $this->bishop_bio = $settings['bishop_bio'] ?? '';

        $this->slides = json_decode($settings['home_slides'] ?? '[]', true);
    }

    public function addSlide()
    {
        $this->validate([
            'newSlide' => 'image|max:2048', 
        ]);

        $path = $this->newSlide->store('slides', 'public');
        $this->slides[] = $path;
        Setting::updateOrCreate(['key' => 'home_slides'], ['value' => json_encode($this->slides)]);
        $this->newSlide = null;
        session()->flash('success', 'Image ajoutée au carrousel.');
    }

    public function removeSlide($index)
    {
        if (isset($this->slides[$index])) {
            Storage::disk('public')->delete($this->slides[$index]);
        }
        unset($this->slides[$index]);
        $this->slides = array_values($this->slides);
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
            'history_text' => $this->history_text,
            'mission_text' => $this->mission_text,
            'bishop_name' => $this->bishop_name,
            'bishop_bio' => $this->bishop_bio,
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