<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Donation extends Component
{
    public function render()
    {
        return view('livewire.public.donation')
            ->layout('layouts.guest');
    }
}
