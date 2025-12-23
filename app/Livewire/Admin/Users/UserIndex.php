<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Parish;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Import obligatoire
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; // Import obligatoire

class UserIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Filtres
    public $search = '';
    public $activeTab = 'all';
    
    // Modale
    public $isOpen = false;
    public $mode = 'create';

    // Champs
    public $userId;
    public $name;
    public $email;
    public $password;
    public $role = 'user'; 
    public $parish_id; 
    public $phone;
    public $is_active = true;
    
    // Photo
    public $photo;      // Fichier temporaire
    public $oldPhoto;   // Chemin bdd

    public $roles = [
        'admin' => 'Administrateur',
        'bishop' => 'Évêque / Chancelier',
        'priest' => 'Prêtre',
        'secretary' => 'Secrétaire',
        'musician' => 'Musicien',
        'user' => 'Fidèle'
    ];

    protected function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId)],
            'role' => 'required|in:admin,bishop,priest,secretary,musician,user',
            'parish_id' => 'nullable|exists:parishes,id',
            'phone' => 'nullable|string',
            'is_active' => 'boolean',
            'photo' => 'nullable|image|max:2048', // Max 2MB
        ];

        if ($this->mode === 'create') {
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = 'nullable|min:8';
        }

        return $rules;
    }

    public function updatedSearch() { $this->resetPage(); }
    public function setTab($tab) { $this->activeTab = $tab; $this->resetPage(); }

    public function create()
    {
        $this->resetInputFields();
        $this->mode = 'create';
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->parish_id = $user->parish_id;
        $this->phone = $user->phone;
        $this->is_active = (bool) $user->is_active;
        $this->oldPhoto = $user->profile_photo_path; // On charge l'ancienne photo
        $this->password = ''; 
        
        $this->mode = 'edit';
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'parish_id' => in_array($this->role, ['priest', 'secretary']) ? $this->parish_id : null,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        // --- GESTION PHOTO (C'est ici que ça se joue) ---
        if ($this->photo) {
            // 1. Si on modifie, on supprime l'ancienne
            if ($this->mode === 'edit' && $this->oldPhoto) {
                Storage::disk('public')->delete($this->oldPhoto);
            }
            // 2. On stocke la nouvelle et on récupère le chemin
            $data['profile_photo_path'] = $this->photo->store('profile-photos', 'public');
        }
        // ------------------------------------------------

        if ($this->mode === 'edit') {
            User::find($this->userId)->update($data);
            session()->flash('success', 'Utilisateur mis à jour.');
        } else {
            User::create($data);
            session()->flash('success', 'Utilisateur créé.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        if ($id === auth()->id()) return;
        
        $user = User::find($id);
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }
        $user->delete();
        
        session()->flash('success', 'Utilisateur supprimé.');
    }

    public function toggleStatus($id)
    {
        if ($id === auth()->id()) return;
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();
        
        $status = $user->is_active ? 'activé' : 'désactivé';
        session()->flash('success', "Compte {$status}.");
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'email', 'password', 'role', 'parish_id', 'phone', 'userId', 'photo', 'oldPhoto']);
        $this->role = 'user';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = User::with('parish')
            ->where(function($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
            });

        match ($this->activeTab) {
            'clergy' => $query->whereIn('role', ['bishop', 'priest', 'secretary']),
            'musicians' => $query->where('role', 'musician'),
            'pending' => $query->where('is_active', false),
            default => null,
        };

        return view('livewire.admin.users.user-index', [
            'users' => $query->latest()->paginate(10),
            'parishes' => Parish::orderBy('name')->get()
        ])->layout('layouts.app');
    }
}