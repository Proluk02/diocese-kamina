<?php

namespace App\Livewire\Admin\Clergy;

use App\Models\User;
use App\Models\Parish;
use App\Models\Assignment;
use App\Models\Necrology;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class ClergyManager extends Component
{
    use WithPagination, WithFileUploads;

    public $tab = 'active'; // 'active' (Prêtres), 'necrology' (Décès)
    public $search = '';
    public $isOpen = false;
    
    // --- MUTATION ---
    public $isTransferModalOpen = false;
    public $selectedPriest;
    public $new_parish_id;
    public $new_function = 'Curé';
    public $transfer_date;

    // --- NÉCROLOGIE ---
    public $necroId, $necroName, $necroTitle, $necroDate, $necroBio, $necroPhoto;

    // Règles
    protected $rules = [
        'new_parish_id' => 'required|exists:parishes,id',
        'new_function' => 'required|string',
        'transfer_date' => 'required|date',
    ];

    public function mount() { $this->transfer_date = date('Y-m-d'); }

    // --- GESTION DES MUTATIONS ---
    
    public function openTransferModal($priestId)
    {
        $this->selectedPriest = User::findOrFail($priestId);
        $this->new_parish_id = $this->selectedPriest->parish_id; // Par défaut actuel
        $this->isTransferModalOpen = true;
    }

    public function executeTransfer()
    {
        $this->validate();

        DB::transaction(function () {
            // 1. Clôturer l'assignation actuelle (Historique)
            Assignment::where('user_id', $this->selectedPriest->id)
                      ->where('is_current', true)
                      ->update(['is_current' => false, 'end_date' => $this->transfer_date]);

            // 2. Créer la nouvelle assignation (Historique)
            Assignment::create([
                'user_id' => $this->selectedPriest->id,
                'parish_id' => $this->new_parish_id,
                'function' => $this->new_function,
                'start_date' => $this->transfer_date,
                'is_current' => true
            ]);

            // 3. Mettre à jour l'utilisateur (C'est ça qui change ses droits d'accès !)
            $this->selectedPriest->update([
                'parish_id' => $this->new_parish_id
            ]);
        });

        session()->flash('success', 'Mutation effectuée. Les droits d\'accès ont été mis à jour.');
        $this->isTransferModalOpen = false;
    }

    // --- GESTION NÉCROLOGIE ---
    
    public function saveNecrology()
    {
        $data = $this->validate([
            'necroName' => 'required',
            'necroTitle' => 'required',
            'necroDate' => 'required|date',
            'necroBio' => 'nullable',
            'necroPhoto' => 'nullable|image|max:2048'
        ]);

        if ($this->necroPhoto) {
            $data['photo_path'] = $this->necroPhoto->store('necrology', 'public');
        }

        Necrology::create([
            'name' => $this->necroName,
            'title' => $this->necroTitle,
            'death_date' => $this->necroDate,
            'biography' => $this->necroBio,
            'photo_path' => $data['photo_path'] ?? null
        ]);

        session()->flash('success', 'Nécrologie ajoutée.');
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.admin.clergy.clergy-manager', [
            'priests' => User::whereIn('role', ['priest', 'bishop'])
                             ->where('name', 'like', '%'.$this->search.'%')
                             ->with('parish')
                             ->paginate(10),
            'necrologies' => Necrology::latest()->get(),
            'parishes' => Parish::orderBy('name')->get()
        ])->layout('layouts.app');
    }
}