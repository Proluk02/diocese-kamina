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

    public $tab = 'active'; 
    public $search = '';
    public $isOpen = false;
    
    // --- MUTATION ---
    public $isTransferModalOpen = false;
    public $selectedPriest;
    public $new_parish_id;
    public $new_function = 'Curé';
    public $transfer_date;

    // --- NÉCROLOGIE ---
    public $necroUserId; 
    public $necroDate;
    public $necroBio;
    public $necroPhoto;

    protected $rules = [
        'new_parish_id' => 'required|exists:parishes,id',
        'new_function' => 'required|string',
        'transfer_date' => 'required|date',
    ];

    public function mount() { $this->transfer_date = date('Y-m-d'); }

    // --- MUTATIONS ---
    public function openTransferModal($priestId)
    {
        $this->selectedPriest = User::findOrFail($priestId);
        $this->new_parish_id = $this->selectedPriest->parish_id;
        $this->isTransferModalOpen = true;
    }

    public function executeTransfer()
    {
        $this->validate();

        DB::transaction(function () {
            Assignment::where('user_id', $this->selectedPriest->id)
                      ->where('is_current', true)
                      ->update(['is_current' => false, 'end_date' => $this->transfer_date]);

            Assignment::create([
                'user_id' => $this->selectedPriest->id,
                'parish_id' => $this->new_parish_id,
                'function' => $this->new_function,
                'start_date' => $this->transfer_date,
                'is_current' => true
            ]);

            $this->selectedPriest->update(['parish_id' => $this->new_parish_id]);
        });

        session()->flash('success', 'Mutation effectuée.');
        $this->isTransferModalOpen = false;
    }

    // --- NÉCROLOGIE ---
    
    public function saveNecrology()
    {
        $this->validate([
            'necroUserId' => 'required|exists:users,id',
            'necroDate' => 'required|date',
            'necroBio' => 'nullable',
            'necroPhoto' => 'nullable|image|max:2048'
        ]);

        DB::transaction(function () {
            $priest = User::findOrFail($this->necroUserId);

            $data = [
                'user_id' => $priest->id,
                'name' => $priest->name,
                'title' => $priest->role === 'bishop' ? 'Monseigneur' : 'Abbé',
                'death_date' => $this->necroDate,
                'biography' => $this->necroBio,
            ];

            if ($this->necroPhoto) {
                $data['photo_path'] = $this->necroPhoto->store('necrology', 'public');
            }

            Necrology::create($data);

            $priest->update([
                'is_active' => false,
                'parish_id' => null
            ]);

            Assignment::where('user_id', $priest->id)
                      ->where('is_current', true)
                      ->update([
                          'is_current' => false, 
                          'end_date' => $this->necroDate
                      ]);
        });

        session()->flash('success', 'Décès enregistré.');
        $this->isOpen = false;
        $this->reset(['necroUserId', 'necroDate', 'necroBio', 'necroPhoto']);
    }
    
    public function deleteNecrology($id)
    {
        $necro = Necrology::findOrFail($id);
        $necro->delete();
        session()->flash('success', 'Entrée supprimée.');
    }

    public function render()
    {
        // On sépare la logique pour éviter l'erreur si la relation n'existe pas encore
        // On récupère d'abord les IDs des utilisateurs déjà décédés
        $deceasedUserIds = Necrology::pluck('user_id')->toArray();

        return view('livewire.admin.clergy.clergy-manager', [
            'priests' => User::whereIn('role', ['priest', 'bishop'])
                             ->where('is_active', true)
                             ->where('name', 'like', '%'.$this->search.'%')
                             ->with('parish')
                             ->paginate(10),
            
            // On filtre manuellement avec whereNotIn au lieu de whereDoesntHave pour éviter le bug de relation
            'allPriests' => User::whereIn('role', ['priest', 'bishop'])
                                ->whereNotIn('id', $deceasedUserIds)
                                ->orderBy('name')
                                ->get(),

            'necrologies' => Necrology::latest()->get(),
            'parishes' => Parish::orderBy('name')->get()
        ])->layout('layouts.app');
    }
}