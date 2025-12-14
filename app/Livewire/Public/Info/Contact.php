<?php

namespace App\Livewire\Public\Info;

use Livewire\Component;
use Illuminate\Support\Facades\Mail; // Import essentiel pour l'envoi
use App\Mail\ContactFormMail;        // Votre classe Mailable
use App\Models\Setting;              // Pour récupérer l'email de destination

class Contact extends Component
{
    // Champs du formulaire
    public $name;
    public $email;
    public $subject;
    public $message;

    // Règles de validation
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        // 1. Validation des données
        $validatedData = $this->validate();

        // 2. Récupération de l'email de l'administrateur depuis les paramètres (Base de données)
        // Si le paramètre n'est pas défini, on utilise une valeur de secours (fallback)
        $adminEmail = Setting::where('key', 'contact_email')->value('value') ?? 'contact@diocesekamina.org';

        // 3. Tentative d'envoi de l'email
        try {
            Mail::to($adminEmail)->send(new ContactFormMail($validatedData));

            // Succès : Message flash + Reset du formulaire
            session()->flash('success', 'Votre message a bien été envoyé. Nous vous répondrons bientôt.');
            $this->reset(); 

        } catch (\Exception $e) {
            // Échec : Message d'erreur (utile si le SMTP est mal configuré en local)
            // En production, il vaut mieux logger l'erreur : \Log::error($e->getMessage());
            
            session()->flash('error', "Une erreur technique est survenue lors de l'envoi. Veuillez vérifier votre connexion ou réessayer plus tard.");
        }
    }

    public function render()
    {
        return view('livewire.public.info.contact')
            ->layout('layouts.guest');
    }
}