<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Parish;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserIndex extends Component
{
    use WithPagination;

    // Filtres
    public $search = '';
    public $activeTab = 'all'; // all, clergy, musicians, pending
    
    // Modale
    public $isOpen = false;
    public $mode = 'create';

    // Champs Formulaire
    public $userId;
    public $name;
    public $email;
    public $password;
    public $role = 'user'; 
    public $parish_id; 
    public $phone;
    public $is_active = true;

    // Listes
    public $roles = [
        'admin' => 'Administrateur',
        'bishop' => 'Évêque / Chancelier',
        'priest' => 'Prêtre (Curé/Vicaire)',
        'secretary' => 'Secrétaire Paroissial',
        'musician' => 'Musicien / Chorale',
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
        ];

        if ($this->mode === 'create') {
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = 'nullable|min:8';
        }

        return $rules;
    }

    public function updatedSearch() { $this->resetPage(); }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        if ($id === auth()->id()) return; // Protection
        
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'activé' : 'désactivé';
        session()->flash('success', "Compte de {$user->name} {$status}.");
    }

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
            // On nettoie le parish_id si le rôle n'est pas clergé
            'parish_id' => in_array($this->role, ['priest', 'secretary']) ? $this->parish_id : null,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

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

        // Filtrage par onglet
        switch ($this->activeTab) {
            case 'clergy':
                $query->whereIn('role', ['bishop', 'priest', 'secretary']);
                break;
            case 'musicians':
                $query->where('role', 'musician');
                break;
            case 'pending':
                $query->where('is_active', false);
                break;
        }

        return view('livewire.admin.users.user-index', [
            'users' => $query->latest()->paginate(10),
            'parishes' => Parish::orderBy('name')->get()
        ])->layout('layouts.app');
    }
}