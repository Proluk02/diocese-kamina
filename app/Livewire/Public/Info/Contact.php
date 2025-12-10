<?php

namespace App\Livewire\Public\Info;

use Livewire\Component;

class Contact extends Component
{
    // Champs du formulaire
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
        
        session()->flash('success', 'Votre message a bien été envoyé. Nous vous répondrons bientôt.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.public.info.contact')
            ->layout('layouts.guest');
    }
}