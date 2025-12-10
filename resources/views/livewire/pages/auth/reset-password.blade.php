<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-50 via-cyan-50 to-green-50 dark:from-gray-900 dark:via-emerald-900/20 dark:to-cyan-900/10 p-4">
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Floating lock icons -->
        <div class="absolute top-16 left-10 w-14 h-14 opacity-10 animate-float-slow">
            <svg class="w-full h-full text-emerald-300" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
            </svg>
        </div>
        <div class="absolute top-1/3 right-20 w-12 h-12 opacity-10 animate-float-medium" style="animation-delay: 1s">
            <svg class="w-full h-full text-cyan-300" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
            </svg>
        </div>
        <div class="absolute bottom-32 left-1/3 w-16 h-16 opacity-10 animate-float-fast" style="animation-delay: 2s">
            <svg class="w-full h-full text-green-300" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        
        <!-- Gradient blobs -->
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-gradient-to-r from-emerald-200/30 to-cyan-200/30 dark:from-emerald-500/10 dark:to-cyan-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/3 left-1/4 w-80 h-80 bg-gradient-to-r from-green-200/20 to-teal-200/20 dark:from-green-500/5 dark:to-teal-500/5 rounded-full blur-3xl"></div>
    </div>
    
    <div class="w-full max-w-5xl relative z-10">
        <!-- Main card with glass effect -->
        <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Left illustration panel -->
                <div class="lg:w-2/5 bg-gradient-to-br from-emerald-600 to-cyan-600 dark:from-emerald-700 dark:to-cyan-700 p-10 flex flex-col justify-center relative overflow-hidden">
                    <!-- Animated pattern overlay -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                            <circle cx="30" cy="30" r="6" fill="white"/>
                            <circle cx="70" cy="50" r="8" fill="white"/>
                            <circle cx="40" cy="70" r="5" fill="white"/>
                            <circle cx="60" cy="20" r="4" fill="white"/>
                            <circle cx="20" cy="50" r="7" fill="white"/>
                        </svg>
                    </div>
                    
                    <!-- Shimmer effect -->
                    <div class="absolute top-0 left-0 w-32 h-full bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 animate-shimmer"></div>
                    
                    <div class="relative z-10 text-center">
                        <!-- Animated shield with checkmark icon -->
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 rounded-3xl mb-6 border-2 border-white/30 backdrop-blur-sm mx-auto relative">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <!-- Animated checkmark that appears after success -->
                            <svg id="success-checkmark" class="w-10 h-10 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 scale-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        
                        <h1 class="text-3xl font-bold text-white mb-4">{{ __('Create New Password') }}</h1>
                        <p class="text-white/90 text-lg leading-relaxed mb-6">
                            {{ __('Choose a strong, secure password to protect your account. Make sure it\'s unique and not used elsewhere.') }}
                        </p>
                        
                        <!-- Security level indicator -->
                        <div class="mt-6">
                            <div class="text-white font-medium mb-2">{{ __('Password Security Level:') }}</div>
                            <div class="h-2 bg-white/30 rounded-full overflow-hidden">
                                <div id="password-strength-bar" class="h-full bg-white w-0 transition-all duration-500"></div>
                            </div>
                            <div id="password-strength-text" class="text-white/80 text-sm mt-2">{{ __('Enter a password to check strength') }}</div>
                        </div>
                        
                        <!-- Password requirements -->
                        <div class="mt-8 space-y-3 text-left">
                            <div class="flex items-center">
                                <div id="req-length" class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm">{{ __('At least 8 characters') }}</span>
                            </div>
                            <div class="flex items-center">
                                <div id="req-uppercase" class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm">{{ __('One uppercase letter') }}</span>
                            </div>
                            <div class="flex items-center">
                                <div id="req-lowercase" class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm">{{ __('One lowercase letter') }}</span>
                            </div>
                            <div class="flex items-center">
                                <div id="req-number" class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm">{{ __('One number') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right form panel -->
                <div class="lg:w-3/5 p-10">
                    <div class="max-w-lg mx-auto">
                        <!-- Header with progress -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ __('Reset Your Password') }}</h2>
                                    <p class="text-gray-600 dark:text-gray-300 mt-1">{{ __('Final step to secure your account') }}</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 rounded-full">
                                        {{ __('Step 3/3') }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Progress indicator -->
                            <div class="relative pt-1">
                                <div class="flex mb-2 items-center justify-between">
                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                        <span class="font-semibold">{{ __('Security Level:') }}</span>
                                        <span id="security-level-text" class="ml-1">{{ __('Low') }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span id="password-score" class="text-xs font-semibold inline-block text-emerald-600 dark:text-emerald-400">0%</span>
                                    </div>
                                </div>
                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-gray-200 dark:bg-gray-700">
                                    <div id="security-progress" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-emerald-500 transition-all duration-500" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email field (read-only) -->
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('Account Email') }}</div>
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-lg font-semibold text-gray-800 dark:text-white">{{ $email }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('This email is verified and secure') }}
                            </div>
                        </div>
                        
                        <form wire:submit="resetPassword" class="space-y-6">
                            <!-- Password field -->
                            <div class="group">
                                <div class="flex items-center justify-between mb-3">
                                    <x-input-label for="password" :value="__('New Password')" class="text-gray-700 dark:text-gray-300 font-medium text-lg" />
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center group-focus-within:bg-emerald-200 dark:group-focus-within:bg-emerald-800/30 transition duration-200">
                                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="relative">
                                    <x-text-input 
                                        wire:model="password" 
                                        id="password" 
                                        class="block w-full pl-12 pr-12 py-4 border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 text-lg shadow-sm"
                                        type="password" 
                                        name="password" 
                                        required 
                                        autocomplete="new-password"
                                        autofocus
                                        placeholder="Enter new password" />
                                    
                                    <!-- Lock icon -->
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    
                                    <!-- Eye toggle -->
                                    <button type="button" 
                                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition duration-200"
                                            onclick="togglePasswordVisibility('password')">
                                        <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Password strength indicator -->
                                <div class="mt-3 grid grid-cols-4 gap-2">
                                    <div class="h-2 rounded-full bg-gray-200 dark:bg-gray-700 strength-segment"></div>
                                    <div class="h-2 rounded-full bg-gray-200 dark:bg-gray-700 strength-segment"></div>
                                    <div class="h-2 rounded-full bg-gray-200 dark:bg-gray-700 strength-segment"></div>
                                    <div class="h-2 rounded-full bg-gray-200 dark:bg-gray-700 strength-segment"></div>
                                </div>
                                
                                <x-input-error :messages="$errors->get('password')" class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 rounded-lg" />
                            </div>

                            <!-- Confirm Password field -->
                            <div class="group">
                                <div class="flex items-center justify-between mb-3">
                                    <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-gray-700 dark:text-gray-300 font-medium text-lg" />
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center group-focus-within:bg-emerald-200 dark:group-focus-within:bg-emerald-800/30 transition duration-200">
                                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="relative">
                                    <x-text-input 
                                        wire:model="password_confirmation" 
                                        id="password_confirmation" 
                                        class="block w-full pl-12 pr-12 py-4 border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 text-lg shadow-sm"
                                        type="password" 
                                        name="password_confirmation" 
                                        required 
                                        autocomplete="new-password"
                                        placeholder="Confirm new password" />
                                    
                                    <!-- Check icon -->
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-emerald-500 transition duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 01118 0z"></path>
                                        </svg>
                                    </div>
                                    
                                    <!-- Eye toggle for confirmation -->
                                    <button type="button" 
                                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition duration-200"
                                            onclick="togglePasswordVisibility('password_confirmation')">
                                        <svg id="confirm-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Match indicator -->
                                <div id="password-match" class="mt-3 text-sm text-gray-500 dark:text-gray-400 flex items-center opacity-0 transition-opacity duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ __('Passwords match') }}</span>
                                </div>
                                
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 rounded-lg" />
                            </div>

                            <!-- Security tips -->
                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800/30 rounded-xl p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white mb-2">{{ __('Create a Strong Password') }}</h3>
                                        <ul class="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                {{ __('Use at least 12 characters for better security') }}
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                {{ __('Mix letters, numbers, and special characters') }}
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                {{ __('Avoid personal information and common words') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="flex flex-col sm:flex-row items-center justify-between pt-6 space-y-4 sm:space-y-0">
                                <a href="{{ route('login') }}" 
                                   class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-200 flex items-center"
                                   wire:navigate>
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    {{ __('Back to Login') }}
                                </a>
                                
                                <x-primary-button 
                                    class="px-8 py-3 rounded-xl text-lg font-medium shadow-lg transform hover:-translate-y-0.5 transition duration-200 group bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="submit-button">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                        <span>{{ __('Reset Password') }}</span>
                                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </div>
                                </x-primary-button>
                            </div>
                        </form>
                        
                        <!-- Additional information -->
                        <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="text-center">
                                <div class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    {{ __('Your new password will be encrypted and securely stored') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Password strength checker
function checkPasswordStrength(password) {
    let score = 0;
    const requirements = {
        length: false,
        uppercase: false,
        lowercase: false,
        number: false,
        special: false
    };
    
    // Length check
    if (password.length >= 8) {
        score += 20;
        requirements.length = true;
        updateRequirement('length', true);
    } else {
        updateRequirement('length', false);
    }
    
    // Uppercase check
    if (/[A-Z]/.test(password)) {
        score += 20;
        requirements.uppercase = true;
        updateRequirement('uppercase', true);
    } else {
        updateRequirement('uppercase', false);
    }
    
    // Lowercase check
    if (/[a-z]/.test(password)) {
        score += 20;
        requirements.lowercase = true;
        updateRequirement('lowercase', true);
    } else {
        updateRequirement('lowercase', false);
    }
    
    // Number check
    if (/[0-9]/.test(password)) {
        score += 20;
        requirements.number = true;
        updateRequirement('number', true);
    } else {
        updateRequirement('number', false);
    }
    
    // Special character check
    if (/[^A-Za-z0-9]/.test(password)) {
        score += 20;
        requirements.special = true;
    }
    
    // Adjust score based on length bonus
    if (password.length >= 12) score += 10;
    if (password.length >= 16) score += 10;
    
    // Cap at 100
    score = Math.min(score, 100);
    
    return {
        score: score,
        requirements: requirements
    };
}

function updateRequirement(type, met) {
    const element = document.getElementById(`req-${type}`);
    const icon = element.querySelector('svg');
    
    if (met) {
        element.classList.remove('bg-white/20');
        element.classList.add('bg-emerald-400/50');
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>';
        icon.classList.remove('opacity-50');
        icon.classList.add('text-white');
    } else {
        element.classList.remove('bg-emerald-400/50');
        element.classList.add('bg-white/20');
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>';
        icon.classList.add('opacity-50');
        icon.classList.remove('text-white');
    }
}

function updatePasswordStrength(password) {
    const result = checkPasswordStrength(password);
    const score = result.score;
    
    // Update progress bar
    const progressBar = document.getElementById('security-progress');
    const strengthBar = document.getElementById('password-strength-bar');
    const scoreText = document.getElementById('password-score');
    const levelText = document.getElementById('security-level-text');
    const strengthText = document.getElementById('password-strength-text');
    
    if (progressBar && strengthBar && scoreText && levelText && strengthText) {
        progressBar.style.width = `${score}%`;
        strengthBar.style.width = `${score}%`;
        scoreText.textContent = `${score}%`;
        
        // Update colors and text based on score
        let color = 'bg-red-500';
        let level = 'Weak';
        let text = 'Add more characters and complexity';
        
        if (score >= 25 && score < 50) {
            color = 'bg-yellow-500';
            level = 'Fair';
            text = 'Getting better, but could be stronger';
        } else if (score >= 50 && score < 75) {
            color = 'bg-blue-500';
            level = 'Good';
            text = 'Strong password, but could be better';
        } else if (score >= 75) {
            color = 'bg-emerald-500';
            level = 'Strong';
            text = 'Excellent! This is a secure password';
        }
        
        progressBar.className = `shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center ${color} transition-all duration-500`;
        strengthBar.className = `h-full ${color} transition-all duration-500`;
        levelText.textContent = level;
        strengthText.textContent = text;
        
        // Update strength segments
        const segments = document.querySelectorAll('.strength-segment');
        const filledSegments = Math.ceil(score / 25);
        
        segments.forEach((segment, index) => {
            segment.className = 'h-2 rounded-full transition-all duration-300';
            if (index < filledSegments) {
                segment.classList.add(color.replace('bg-', 'bg-'));
            } else {
                segment.classList.add('bg-gray-200', 'dark:bg-gray-700');
            }
        });
    }
}

function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    const eyeIcon = document.getElementById(fieldId === 'password' ? 'password-eye' : 'confirm-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
    } else {
        field.type = 'password';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
    }
}

// Livewire event listeners
document.addEventListener('livewire:initialized', () => {
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('password_confirmation');
    const matchIndicator = document.getElementById('password-match');
    
    if (passwordField) {
        passwordField.addEventListener('input', (e) => {
            updatePasswordStrength(e.target.value);
            checkPasswordMatch();
        });
    }
    
    if (confirmField) {
        confirmField.addEventListener('input', checkPasswordMatch);
    }
    
    function checkPasswordMatch() {
        const password = passwordField ? passwordField.value : '';
        const confirm = confirmField ? confirmField.value : '';
        const submitButton = document.getElementById('submit-button');
        
        if (confirm.length > 0) {
            if (password === confirm) {
                matchIndicator.classList.remove('opacity-0', 'text-red-500');
                matchIndicator.classList.add('opacity-100', 'text-emerald-500');
                matchIndicator.querySelector('span').textContent = 'Passwords match';
                
                // Update check icon
                const icon = matchIndicator.querySelector('svg');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
                
                if (submitButton) {
                    submitButton.disabled = false;
                }
            } else {
                matchIndicator.classList.remove('opacity-0', 'text-emerald-500');
                matchIndicator.classList.add('opacity-100', 'text-red-500');
                matchIndicator.querySelector('span').textContent = 'Passwords do not match';
                
                // Update X icon
                const icon = matchIndicator.querySelector('svg');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                
                if (submitButton) {
                    submitButton.disabled = true;
                }
            }
        } else {
            matchIndicator.classList.remove('opacity-100');
            matchIndicator.classList.add('opacity-0');
            
            if (submitButton) {
                submitButton.disabled = false;
            }
        }
    }
    
    // Check initial state
    checkPasswordMatch();
    if (passwordField && passwordField.value) {
        updatePasswordStrength(passwordField.value);
    }
});

// Success animation
document.addEventListener('livewire:initialized', () => {
    @this.on('password-reset', (event) => {
        // Show success animation
        const shield = document.querySelector('.relative svg:first-child');
        const checkmark = document.getElementById('success-checkmark');
        
        if (shield && checkmark) {
            // Animate shield
            shield.style.transition = 'all 0.5s ease';
            shield.style.transform = 'scale(0.8)';
            shield.style.opacity = '0.5';
            
            // Show checkmark
            setTimeout(() => {
                checkmark.style.opacity = '1';
                checkmark.style.transition = 'all 0.5s ease';
                checkmark.style.transform = 'translate(-50%, -50%) scale(1)';
            }, 300);
        }
    });
});
</script>

<style>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}
@keyframes float-medium {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(-3deg); }
}
@keyframes float-fast {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(2deg); }
}
@keyframes shimmer {
    0% { transform: translateX(-100%) skewX(-12deg); }
    100% { transform: translateX(200%) skewX(-12deg); }
}
.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}
.animate-float-medium {
    animation: float-medium 4s ease-in-out infinite;
}
.animate-float-fast {
    animation: float-fast 3s ease-in-out infinite;
}
.animate-shimmer {
    animation: shimmer 3s infinite;
}
</style>