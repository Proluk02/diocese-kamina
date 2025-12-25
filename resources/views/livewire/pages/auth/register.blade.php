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

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'is_active' => $this->role === 'user',
        ]);

        event(new Registered($user));

        if ($this->role === 'musician') {
            session()->flash('status', 'Validation requise par l\'administrateur.');
            $this->redirect(route('login'), navigate: true);
        } else {
            Auth::login($user);
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>

<div class="min-h-screen flex flex-col justify-center items-center px-4 bg-slate-50 dark:bg-gray-950 transition-colors duration-500 py-16">
    <div class="w-full max-w-[450px]">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-slate-900 dark:text-white font-playfair tracking-tight mb-2">Rejoignez-nous</h1>
            <p class="text-sm text-slate-500 dark:text-gray-400 font-medium uppercase tracking-widest">Création de compte membre</p>
        </div>

        <div class="bg-white dark:bg-gray-900 shadow-xl rounded-[2.5rem] p-8 md:p-10 border border-slate-100 dark:border-gray-800" x-data="{ show: false }">
            
            <form wire:submit="register" class="space-y-5">
                <!-- Nom -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-gray-400 mb-1.5 ml-1">Nom Complet</label>
                    <input wire:model="name" type="text" placeholder="Jean Dupont"
                        class="w-full rounded-2xl border-slate-200 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800 text-sm p-3.5 focus:ring-2 focus:ring-kamina-blue/20 focus:border-kamina-blue transition-all dark:text-white" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-gray-400 mb-1.5 ml-1">Email</label>
                    <input wire:model="email" type="email" placeholder="nom@exemple.com"
                        class="w-full rounded-2xl border-slate-200 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800 text-sm p-3.5 focus:ring-2 focus:ring-kamina-blue/20 focus:border-kamina-blue transition-all dark:text-white" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Type de Compte -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-gray-400 mb-1.5 ml-1">Je suis un...</label>
                    <select wire:model.live="role" 
                        class="w-full rounded-2xl border-slate-200 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800 text-sm p-3.5 focus:ring-2 focus:ring-kamina-blue/20 focus:border-kamina-blue transition-all font-bold dark:text-white">
                        <option value="user">Fidèle du Diocèse</option>
                        <option value="musician">Musicien / Choriste</option>
                    </select>
                </div>

                @if($role === 'musician')
                <div x-transition class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800">
                    <p class="text-[10px] font-bold text-blue-700 dark:text-blue-300 leading-relaxed uppercase">
                        ℹ️ Les comptes musiciens sont vérifiés par l'administration avant d'accéder aux partitions.
                    </p>
                </div>
                @endif

                <!-- Mots de passe -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-gray-400 mb-1.5 ml-1">Mot de passe</label>
                        <input wire:model="password" :type="show ? 'text' : 'password'"
                            class="w-full rounded-2xl border-slate-200 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800 text-sm p-3.5 focus:ring-2 focus:ring-kamina-blue/20 focus:border-kamina-blue transition-all dark:text-white" required />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-gray-400 mb-1.5 ml-1">Confirmation</label>
                        <input wire:model="password_confirmation" :type="show ? 'text' : 'password'"
                            class="w-full rounded-2xl border-slate-200 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800 text-sm p-3.5 focus:ring-2 focus:ring-kamina-blue/20 focus:border-kamina-blue transition-all dark:text-white" required />
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />

                <div class="flex items-center ml-1">
                    <input type="checkbox" @click="show = !show" class="rounded border-slate-300 text-kamina-blue focus:ring-kamina-blue/20" id="v_pass">
                    <label for="v_pass" class="ml-2 text-xs font-bold text-slate-500 dark:text-gray-400 cursor-pointer uppercase">Afficher les mots de passe</label>
                </div>

                <button type="submit" class="w-full py-4 bg-kamina-blue hover:bg-blue-800 text-white rounded-2xl font-black text-sm shadow-xl shadow-blue-500/20 transition-all hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                    S'inscrire maintenant
                </button>
            </form>

            <div class="mt-10 pt-6 border-t border-slate-50 dark:border-gray-800 text-center">
                <a href="{{ route('login') }}" wire:navigate class="text-xs font-black text-kamina-gold hover:text-amber-600 transition-colors uppercase tracking-widest">
                    Déjà inscrit ? Se connecter
                </a>
            </div>
        </div>
    </div>
</div>