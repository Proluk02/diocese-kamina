<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="py-6 space-y-6">
        
        <!-- Info Profil -->
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <!-- Mot de passe -->
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <!-- Suppression (Zone Danger) -->
        <div class="p-4 sm:p-8 bg-red-50 dark:bg-red-900/10 shadow-sm sm:rounded-2xl border border-red-100 dark:border-red-800">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>