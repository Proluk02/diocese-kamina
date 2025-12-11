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

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl rounded-2xl border-t-4 border-kamina-gold overflow-hidden">
        
        <!-- En-tête -->
        <div class="text-center mb-8">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
            <h2 class="mt-4 text-2xl font-bold text-gray-900 font-playfair">Espace Membres</h2>
            <p class="text-sm text-gray-500">Connectez-vous pour accéder à l'administration.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <!-- Email Address -->
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">Adresse Email</label>
                <input wire:model="form.email" id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-kamina-blue focus:ring-kamina-blue shadow-sm" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Mot de passe</label>
                <input wire:model="form.password" id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-kamina-blue focus:ring-kamina-blue shadow-sm" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-kamina-blue shadow-sm focus:ring-kamina-blue" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-kamina-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kamina-blue" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif

                <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-kamina-blue border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-kamina-gold focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    {{ __('Connexion') }}
                </button>
            </div>
        </form>
    </div>
    
    <div class="mt-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Diocèse de Kamina.
    </div>
</div>