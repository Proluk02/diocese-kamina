<?php

namespace App\Livewire\Public\Info;

use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        // Ici, vous mettriez la logique d'envoi d'email (Mail::to(...))
        // Pour l'instant, on simule un succès
        
        session()->flash('success', 'Votre message a bien été envoyé. Le secrétariat vous répondra dans les plus brefs délais.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.public.info.contact')->layout('layouts.guest');
    }
}