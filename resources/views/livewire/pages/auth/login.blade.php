<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Gère la tentative de connexion.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // LOGIQUE DE REDIRECTION SELON LE RÔLE
        if (auth()->user()->role === 'user') {
            // Un simple fidèle est redirigé vers l'accueil
            $this->redirect(route('home'), navigate: true);
        } else {
            // Un admin ou un musicien va vers le dashboard
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>

<div class="min-h-screen flex flex-col justify-center items-center px-4 bg-slate-50 dark:bg-gray-950 transition-colors duration-500 py-12">
    <div class="w-full max-w-[400px]">
        
        <!-- En-tête (Logo & Titre) -->
        <div class="text-center mb-8">
            <a href="/" wire:navigate class="inline-flex items-center justify-center w-16 h-16 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-slate-100 dark:border-gray-800 mb-4 transition-transform hover:scale-105">
                <span class="text-2xl font-black text-kamina-blue">DK</span>
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white font-playfair tracking-tight">Espace Membres</h1>
            <p class="text-sm text-slate-500 dark:text-gray-400 mt-1 font-medium italic">Diocèse de Kamina</p>
        </div>

        <!-- Carte de Connexion -->
        <div class="bg-white dark:bg-gray-900 shadow-xl shadow-slate-200/50 dark:shadow-none rounded-[2.5rem] p-8 border border-slate-100 dark:border-gray-800 relative overflow-hidden">
            
            <!-- Statut de session (ex: Mot de passe envoyé) -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Bouton Google -->
            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-xl text-sm font-bold text-slate-700 dark:text-gray-200 hover:bg-slate-50 dark:hover:bg-gray-700 transition-all mb-6 group">
                <svg class="w-5 h-5 transition-transform group-hover:scale-110" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                <span class="tracking-tight">Continuer avec Google</span>
            </a>

            <!-- Séparateur -->
            <div class="relative mb-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-100 dark:border-gray-800"></div>
                </div>
                <div class="relative flex justify-center text-[10px] uppercase tracking-[0.25em] font-black text-slate-400 bg-white dark:bg-gray-900 px-4">
                    Ou par email
                </div>
            </div>

            <!-- Formulaire -->
            <form wire:submit="login" x-data="{ show: false }">
                <div class="space-y-4">
                    <!-- Adresse Email -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-gray-400 mb-1.5 ml-1">Adresse Email</label>
                        <input wire:model="form.email" type="email" placeholder="nom@exemple.com"
                            class="w-full rounded-2xl border-slate-200 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800 text-sm p-4 focus:ring-2 focus:ring-kamina-blue/20 focus:border-kamina-blue transition-all dark:text-white placeholder-slate-400" required autofocus />
                        <x-input-error :messages="$errors->get('form.email')" class="mt-1 ml-1" />
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <div class="flex justify-between mb-1.5 ml-1">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-gray-400">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-black uppercase text-kamina-blue hover:text-blue-700 transition-colors">Oublié ?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <input wire:model="form.password" :type="show ? 'text' : 'password'" placeholder="••••••••"
                                class="w-full rounded-2xl border-slate-200 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800 text-sm p-4 focus:ring-2 focus:ring-kamina-blue/20 focus:border-kamina-blue transition-all pr-12 dark:text-white placeholder-slate-400" required />
                            
                            <!-- Bouton Afficher/Cacher -->
                            <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-kamina-blue transition-colors focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2"/></svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" stroke-width="2" stroke-linecap="round"/></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-1 ml-1" />
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mt-5 mb-8 ml-1">
                    <input wire:model="form.remember" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-kamina-blue focus:ring-kamina-blue/20 transition-all" id="remember">
                    <label for="remember" class="ml-2 text-[11px] font-bold text-slate-500 dark:text-gray-400 cursor-pointer uppercase tracking-tight">Se souvenir de moi</label>
                </div>

                <!-- Bouton Submit -->
                <button type="submit" class="w-full py-4 bg-kamina-blue hover:bg-blue-800 text-white rounded-2xl font-black text-sm shadow-xl shadow-blue-500/20 transition-all hover:-translate-y-1 active:scale-95 uppercase tracking-[0.15em]">
                    Se connecter
                </button>
            </form>

            <!-- Pied de carte -->
            <div class="mt-10 text-center border-t border-slate-50 dark:border-gray-800 pt-6">
                <p class="text-sm text-slate-500 dark:text-gray-400 mb-2">Pas encore de compte ?</p>
                <a href="{{ route('register') }}" wire:navigate class="text-xs font-black text-kamina-gold uppercase tracking-[0.1em] hover:text-amber-600 transition-colors">
                    Créer un compte membre
                </a>
            </div>
        </div>
        
        <!-- Copyright -->
        <p class="text-center text-[10px] font-black text-slate-400 dark:text-gray-600 mt-10 uppercase tracking-[0.4em]">&copy; {{ date('Y') }} — Diocèse de Kamina</p>
    </div>
</div>