<?php

namespace App\Livewire\Admin\Parishes;

use App\Models\Parish;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ParishIndex extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isOpen = false;
    public $mode = 'create';

    // Champs
    public $parishId;
    public $name;
    public $city = 'Kamina';
    public $address;
    public $contact_phone;
    
    // Rich Texts (Initialisés à vide pour éviter le NULL)
    public $history = ''; 
    public $mass_schedules = ''; 
    
    public $photo;
    public $oldPhoto;
    
    // Affichage
    public $currentParish;

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'city' => 'required',
            'address' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'history' => 'nullable|string',
            'mass_schedules' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    public function updatedSearch() { $this->resetPage(); }

    public function create()
    {
        $this->resetInputFields();
        $this->mode = 'create';
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $parish = Parish::findOrFail($id);
        $this->parishId = $id;
        $this->name = $parish->name;
        $this->city = $parish->city;
        $this->address = $parish->address;
        $this->contact_phone = $parish->contact_phone;
        
        // Gestion des NULLs pour Rich Text
        $this->history = $parish->history ?? '';
        $this->mass_schedules = $parish->mass_schedules ?? '';
        
        $this->oldPhoto = $parish->photo_path;
        
        $this->mode = 'edit';
        $this->isOpen = true;
    }

    public function show($id)
    {
        $this->currentParish = Parish::findOrFail($id);
        $this->mode = 'show';
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'city' => $this->city,
            'address' => $this->address,
            'contact_phone' => $this->contact_phone,
            'history' => $this->history ?? '',
            'mass_schedules' => $this->mass_schedules ?? '',
        ];

        if ($this->photo) {
            if ($this->mode === 'edit' && $this->oldPhoto) {
                Storage::disk('public')->delete($this->oldPhoto);
            }
            $data['photo_path'] = $this->photo->store('parishes', 'public');
        }

        if ($this->mode === 'edit') {
            Parish::find($this->parishId)->update($data);
            session()->flash('success', 'Paroisse mise à jour.');
        } else {
            Parish::create($data);
            session()->flash('success', 'Paroisse créée.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $parish = Parish::findOrFail($id);
        if ($parish->photo_path) Storage::disk('public')->delete($parish->photo_path);
        $parish->delete();
        session()->flash('success', 'Paroisse supprimée.');
        if($this->isOpen) $this->closeModal();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'city', 'address', 'contact_phone', 'photo', 'oldPhoto', 'parishId', 'currentParish']);
        $this->history = '';
        $this->mass_schedules = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.parishes.parish-index', [
            'parishes' => Parish::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('city', 'like', '%'.$this->search.'%')
                ->latest()
                ->paginate(10)
        ])->layout('layouts.app');
    }
}