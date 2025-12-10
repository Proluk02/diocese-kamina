<?php

namespace App\Livewire\Public\Info;

use Livewire\Component;

class Presentation extends Component
{
    public function render()
    {
        return view('livewire.public.info.presentation')->layout('layouts.guest');
    }
}