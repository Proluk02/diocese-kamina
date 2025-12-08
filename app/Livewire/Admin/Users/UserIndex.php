<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Parish;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $isOpen = false;
    public $mode = 'create';

    // Champs
    public $userId;
    public $name;
    public $email;
    public $password;
    public $role = 'user'; // admin, bishop, priest, secretary, musician, user
    public $parish_id; // Pour lier à une paroisse
    public $phone;

    // Listes pour les selects
    public $roles = [
        'admin' => 'Administrateur',
        'bishop' => 'Évêque / Chancelier',
        'priest' => 'Prêtre (Curé/Vicaire)',
        'secretary' => 'Secrétaire Paroissial',
        'musician' => 'Musicien / Chorale',
        'user' => 'Fidèle (Simple utilisateur)',
    ];

    protected function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId)],
            'role' => 'required|in:admin,bishop,priest,secretary,musician,user',
            'parish_id' => 'nullable|exists:parishes,id',
            'phone' => 'nullable|string',
        ];

        // Mot de passe obligatoire seulement à la création
        if ($this->mode === 'create') {
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = 'nullable|min:8';
        }

        return $rules;
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
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->parish_id = $user->parish_id;
        $this->phone = $user->phone;
        $this->password = ''; // On ne remplit pas le mot de passe pour sécurité
        
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
        ];

        // Si un mot de passe est fourni, on le hash
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->mode === 'edit') {
            User::find($this->userId)->update($data);
            session()->flash('success', 'Utilisateur mis à jour.');
        } else {
            User::create($data);
            session()->flash('success', 'Utilisateur créé avec succès.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        if ($id === auth()->id()) {
            session()->flash('error', 'Vous ne pouvez pas supprimer votre propre compte.');
            return;
        }

        User::find($id)->delete();
        session()->flash('success', 'Utilisateur supprimé.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'email', 'password', 'role', 'parish_id', 'phone', 'userId']);
        $this->role = 'user';
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.users.user-index', [
            'users' => User::with('parish')
                ->where(function($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('email', 'like', '%'.$this->search.'%');
                })
                ->when($this->roleFilter, fn($q) => $q->where('role', $this->roleFilter))
                ->latest()
                ->paginate(10),
            'parishes' => Parish::orderBy('name')->get() // Pour le select
        ])->layout('layouts.app');
    }
}