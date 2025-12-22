<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-brand-light dark:bg-gray-900 transition-colors duration-300">
    
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-2xl rounded-[2rem] border-t-4 border-kamina-gold overflow-hidden relative">
        
        <!-- Décoration -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-32 h-32 bg-kamina-blue/10 rounded-full blur-2xl"></div>

        <!-- En-tête -->
        <div class="text-center mb-8 relative z-10">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
            <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white font-playfair">Espace Membres</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Connectez-vous pour accéder à l'administration.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <!-- Email Address -->
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Adresse Email</label>
                <input wire:model="form.email" id="email" class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-kamina-blue focus:ring-kamina-blue shadow-sm p-3" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Mot de passe</label>
                <input wire:model="form.password" id="password" class="block mt-1 w-full rounded-xl border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-kamina-blue focus:ring-kamina-blue shadow-sm p-3" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-kamina-blue shadow-sm focus:ring-kamina-blue dark:bg-gray-900" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-xs text-gray-500 dark:text-gray-400 hover:text-kamina-blue dark:hover:text-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kamina-blue transition-colors" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>
            
            <button type="submit" class="mt-4 w-full inline-flex justify-center items-center px-4 py-3 bg-kamina-blue border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-kamina-gold focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">
                {{ __('Connexion') }}
            </button>
        </form>
        
        <!-- Lien vers Inscription -->
        <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">Pas encore de compte ?</p>
            <a href="{{ route('register') }}" wire:navigate class="text-sm font-bold text-kamina-gold hover:underline mt-1 inline-block">
                Créer un compte maintenant
            </a>
        </div>
    </div>
    
    <div class="mt-8 text-center text-xs text-gray-400 dark:text-gray-600">
        &copy; {{ date('Y') }} Diocèse de Kamina. Tous droits réservés.
    </div>
</div>