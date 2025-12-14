<?php

namespace App\Livewire\Admin\Parishes;

use App\Models\Parish;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ParishIndex extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isOpen = false;
    public $mode = 'create';

    public $parishId;
    public $name;
    public $city = 'Kamina';
    public $address;
    public $contact_phone;
    
    // GPS
    public $latitude;
    public $longitude;
    
    // Rich Text (Initialisé vide)
    public $history = ''; 
    public $mass_schedules = ''; 
    
    public $photo;
    public $oldPhoto;
    public $currentParish;

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'city' => 'required',
            'address' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'history' => 'nullable|string',
            'mass_schedules' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    public function updatedSearch() { $this->resetPage(); }

    public function create()
    {
        // Seul l'admin peut créer une paroisse
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Action non autorisée.');
        }
        $this->resetInputFields();
        $this->mode = 'create';
        $this->isOpen = true;
    }

    public function edit($id)
    {
        // Vérification permission (Si prêtre, doit être SA paroisse)
        $user = auth()->user();
        if (!$user->isAdmin() && $user->parish_id != $id) {
            abort(403, 'Vous ne pouvez modifier que votre paroisse.');
        }

        $parish = Parish::findOrFail($id);
        $this->parishId = $id;
        $this->name = $parish->name;
        $this->city = $parish->city;
        $this->address = $parish->address;
        $this->contact_phone = $parish->contact_phone;
        $this->latitude = $parish->latitude;
        $this->longitude = $parish->longitude;
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
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
        if (!auth()->user()->isAdmin()) abort(403); // Seul l'admin supprime

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
        $this->reset(['name', 'city', 'address', 'contact_phone', 'latitude', 'longitude', 'photo', 'oldPhoto', 'parishId', 'currentParish']);
        $this->history = '';
        $this->mass_schedules = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Parish::query();
        if (!auth()->user()->isAdmin()) {
            $query->where('id', auth()->user()->parish_id);
        }

        return view('livewire.admin.parishes.parish-index', [
            'parishes' => $query->latest()->paginate(10)
        ])->layout('layouts.app');
    }
}