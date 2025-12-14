<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    
    // Nouveau champ Rôle
    public string $role = 'user'; 

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,musician'], // Validation
        ]);

        // Création de l'utilisateur
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ];

        // Si c'est un musicien, on le met en "inactif" (en attente de validation)
        if ($this->role === 'musician') {
            $userData['is_active'] = false;
        } else {
            $userData['is_active'] = true;
        }

        $user = User::create($userData);

        event(new Registered($user));

        // Redirection selon le rôle
        if ($this->role === 'musician') {
            session()->flash('status', 'Compte créé ! Veuillez attendre la validation de l\'administrateur pour accéder à l\'espace Musiciens.');
            $this->redirect(route('login'), navigate: true);
        } else {
            Auth::login($user);
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl rounded-2xl border-t-4 border-kamina-gold overflow-hidden">
        
        <!-- En-tête -->
        <div class="text-center mb-8">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
            <h2 class="mt-4 text-2xl font-bold text-gray-900 font-playfair">Créer un compte</h2>
            <p class="text-sm text-gray-500">Rejoignez la communauté numérique du diocèse.</p>
        </div>

        <form wire:submit="register">
            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nom Complet</label>
                <input wire:model="name" id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-kamina-blue focus:ring-kamina-blue shadow-sm" type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Adresse Email</label>
                <input wire:model="email" id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-kamina-blue focus:ring-kamina-blue shadow-sm" type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Type de Compte (Nouveau) -->
            <div class="mt-4">
                <label for="role" class="block font-medium text-sm text-gray-700">Type de compte</label>
                <select wire:model="role" id="role" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-kamina-blue focus:ring-kamina-blue shadow-sm">
                    <option value="user">Fidèle (Accès simple)</option>
                    <option value="musician">Musicien / Chorale (Validation requise)</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Les comptes musiciens doivent être approuvés par le service communication.</p>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Mot de passe</label>
                <input wire:model="password" id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-kamina-blue focus:ring-kamina-blue shadow-sm" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmer le mot de passe</label>
                <input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-kamina-blue focus:ring-kamina-blue shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-kamina-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kamina-blue" href="{{ route('login') }}" wire:navigate>
                    {{ __('Déjà inscrit ?') }}
                </a>

                <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-kamina-blue border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-kamina-gold focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    {{ __('S\'inscrire') }}
                </button>
            </div>
        </form>
    </div>
</div>