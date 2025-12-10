<?php

namespace App\Livewire\Public\Parishes;

use App\Models\Parish;
use Livewire\Component;

class ParishDetail extends Component
{
    public $parish;

    public function mount($id)
    {
        $this->parish = Parish::with('users')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.public.parishes.parish-detail')->layout('layouts.guest');
    }
}