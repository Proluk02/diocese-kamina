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
    public string $role = 'user'; 

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,musician'],
        ]);

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            // Musicien = Inactif par défaut
            'is_active' => $this->role === 'user' ? true : false,
        ];

        $user = User::create($userData);

        event(new Registered($user));

        if ($this->role === 'musician') {
            session()->flash('status', 'Compte créé ! Veuillez attendre la validation de l\'administrateur pour accéder à l\'espace Musiciens.');
            $this->redirect(route('login'), navigate: true);
        } else {
            Auth::login($user);
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-brand-light dark:bg-gray-900 transition-colors duration-300">
    
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-2xl rounded-[2rem] border-t-4 border-kamina-gold overflow-hidden relative">
        
        <!-- Décoration -->
        <div class="absolute top-0 left-0 -mt-10 -ml-10 w-32 h-32 bg-kamina-gold/10 rounded-full blur-2xl"></div>

        <!-- En-tête -->
        <div class="text-center mb-8 relative z-10">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
            <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white font-playfair">Créer un compte</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Rejoignez la communauté numérique du diocèse.</p>
        </div>

        <form wire:submit="register">
            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nom Complet</label>
                <input wire:model="name" id="name" class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-kamina-blue focus:ring-kamina-blue shadow-sm p-3" type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Adresse Email</label>
                <input wire:model="email" id="email" class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-kamina-blue focus:ring-kamina-blue shadow-sm p-3" type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Type de Compte -->
            <div class="mt-4">
                <label for="role" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Type de compte</label>
                <select wire:model.live="role" id="role" class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-kamina-blue focus:ring-kamina-blue shadow-sm p-3">
                    <option value="user">Fidèle (Accès simple)</option>
                    <option value="musician">Musicien / Chorale (Validation requise)</option>
                </select>
                
                @if($role === 'musician')
                    <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-2 bg-yellow-50 dark:bg-yellow-900/20 p-2 rounded-lg border border-yellow-100 dark:border-yellow-800">
                        ⚠️ Les comptes musiciens doivent être approuvés par le service communication avant activation.
                    </p>
                @endif
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Mot de passe</label>
                <input wire:model="password" id="password" class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-kamina-blue focus:ring-kamina-blue shadow-sm p-3" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Confirmer le mot de passe</label>
                <input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-kamina-blue focus:ring-kamina-blue shadow-sm p-3" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="mt-6 w-full inline-flex justify-center items-center px-4 py-3 bg-kamina-blue border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-kamina-gold focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">
                {{ __('S\'inscrire') }}
            </button>
        </form>

        <!-- Lien vers Connexion -->
        <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">Déjà inscrit ?</p>
            <a href="{{ route('login') }}" wire:navigate class="text-sm font-bold text-kamina-gold hover:underline mt-1 inline-block">
                Se connecter
            </a>
        </div>
    </div>
    
    <div class="mt-8 text-center text-xs text-gray-400 dark:text-gray-600">
        &copy; {{ date('Y') }} Diocèse de Kamina.
    </div>
</div>