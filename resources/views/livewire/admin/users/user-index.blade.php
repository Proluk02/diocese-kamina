<div class="space-y-6 animate-fadeIn pb-10">
    
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">Utilisateurs & Rôles</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gérez les accès : prêtres, secrétaires, musiciens...</p>
        </div>
        <button wire:click="create" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-kamina-blue hover:bg-blue-800 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Nouvel Utilisateur
        </button>
    </div>

    <!-- TABS -->
    <div class="flex flex-wrap gap-2 border-b border-gray-200 dark:border-gray-700">
        <button wire:click="setTab('all')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition {{ $activeTab === 'all' ? 'bg-white dark:bg-gray-800 text-kamina-blue border-b-2 border-kamina-blue' : 'text-gray-500 hover:text-gray-700' }}">Tous</button>
        <button wire:click="setTab('clergy')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition {{ $activeTab === 'clergy' ? 'bg-white dark:bg-gray-800 text-kamina-blue border-b-2 border-kamina-blue' : 'text-gray-500 hover:text-gray-700' }}">Clergé & Staff</button>
        <button wire:click="setTab('musicians')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition {{ $activeTab === 'musicians' ? 'bg-white dark:bg-gray-800 text-kamina-blue border-b-2 border-kamina-blue' : 'text-gray-500 hover:text-gray-700' }}">Musiciens</button>
        <button wire:click="setTab('pending')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition flex items-center gap-2 {{ $activeTab === 'pending' ? 'bg-white dark:bg-gray-800 text-red-600 border-b-2 border-red-600' : 'text-gray-500 hover:text-red-500' }}">
            En attente
            @php $pendingCount = \App\Models\User::where('is_active', false)->count(); @endphp
            @if($pendingCount > 0) <span class="bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span> @endif
        </button>
    </div>

    <!-- TABLEAU -->
    <div class="bg-white dark:bg-gray-800 rounded-b-2xl rounded-tr-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-4 border-b border-gray-100 dark:border-gray-700">
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full md:w-80 pl-4 pr-3 py-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-900 text-sm focus:ring-kamina-gold" placeholder="Rechercher...">
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Utilisateur</th>
                        <th class="px-6 py-4 font-semibold">Rôle</th>
                        <th class="px-6 py-4 font-semibold">Affectation</th>
                        <th class="px-6 py-4 text-center font-semibold">État</th>
                        <th class="px-6 py-4 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-kamina-blue text-white flex items-center justify-center font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 dark:text-white">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badgeColor = match($user->role) {
                                    'admin' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                    'bishop' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
                                    'priest' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                    'secretary' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-400',
                                    'musician' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
                                    default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300'
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeColor }}">
                                {{ $roles[$user->role] ?? ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ $user->parish->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($user->is_active)
                                <span class="text-green-600 text-xs font-bold bg-green-100 px-2 py-1 rounded-full">Actif</span>
                            @else
                                <span class="text-red-600 text-xs font-bold bg-red-100 px-2 py-1 rounded-full animate-pulse">En attente</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                            <!-- Toggle Status -->
                            @if($user->id !== auth()->id())
                                <button wire:click="toggleStatus({{ $user->id }})" class="p-2 rounded-lg transition {{ $user->is_active ? 'text-orange-500 hover:bg-orange-50' : 'text-green-600 hover:bg-green-50 bg-green-50' }}" title="{{ $user->is_active ? 'Désactiver' : 'Valider le compte' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($user->is_active) <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        @else <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /> @endif
                                    </svg>
                                </button>
                            @endif

                            <button wire:click="edit({{ $user->id }})" class="p-2 text-gray-400 hover:text-kamina-gold"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                            
                            @if($user->id !== auth()->id())
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Supprimer ce compte ?" class="p-2 text-gray-400 hover:text-red-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-8 text-center text-gray-500">Aucun utilisateur trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">{{ $users->links() }}</div>
    </div>

    <!-- MODALE -->
    @if($isOpen)
    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:w-full sm:max-w-lg border border-gray-100 dark:border-gray-700">
                
                <div class="bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-kamina-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        {{ $mode === 'edit' ? 'Modifier Utilisateur' : 'Nouvel Utilisateur' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>

                <div class="px-6 py-6 space-y-5">
                    
                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nom Complet</label>
                        <input type="text" wire:model="name" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Adresse Email</label>
                        <input type="email" wire:model="email" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                        <input type="text" wire:model="phone" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4"></div>

                    <!-- Rôle -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Rôle Système</label>
                        <select wire:model.live="role" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                            @foreach($roles as $key => $label) <option value="{{ $key }}">{{ $label }}</option> @endforeach
                        </select>
                        @error('role') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Paroisse (Conditionnel) -->
                    @if(in_array($role, ['priest', 'secretary']))
                    <div class="animate-fadeIn p-4 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-100 dark:border-blue-800">
                        <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300 mb-1">Paroisse d'affectation</label>
                        <select wire:model="parish_id" class="block w-full rounded-lg border-blue-200 dark:border-blue-800 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                            <option value="">Sélectionner une paroisse...</option>
                            @foreach($parishes as $parish)
                                <option value="{{ $parish->id }}">{{ $parish->name }} ({{ $parish->city }})</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Obligatoire pour lier les publications à la paroisse.</p>
                    </div>
                    @endif

                    <!-- Mot de passe -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                            {{ $mode === 'edit' ? 'Nouveau mot de passe (Laisser vide pour ne pas changer)' : 'Mot de passe' }}
                        </label>
                        <input type="password" wire:model="password" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:ring-kamina-gold focus:border-kamina-gold p-2.5">
                        @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-row-reverse gap-3 rounded-b-2xl border-t border-gray-100 dark:border-gray-700">
                    <button wire:click="save" class="inline-flex w-full justify-center rounded-lg bg-kamina-blue px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-blue-800 transition-all sm:w-auto">
                        {{ $mode === 'edit' ? 'Mettre à jour' : 'Créer' }}
                    </button>
                    <button wire:click="closeModal" class="inline-flex w-full justify-center rounded-lg bg-white dark:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-500 hover:bg-gray-50 dark:hover:bg-gray-500 transition-all sm:w-auto">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>