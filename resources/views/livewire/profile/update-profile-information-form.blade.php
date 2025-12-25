<?php
use App\Models\User;
use App\Models\Parish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public ?string $phone = null;
    public ?int $parish_id = null;
    public $photo;

    public function mount(): void {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->parish_id = $user->parish_id;
    }

    public function updateProfileInformation(): void {
        $user = Auth::user();
        
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'parish_id' => ['nullable', 'exists:parishes,id'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($this->photo) {
            if ($user->profile_photo_path) Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = $this->photo->store('profile-photos', 'public');
        }

        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'parish_id' => $this->parish_id,
        ])->save();

        $this->photo = null;
        $this->dispatch('profile-updated');
    }

    public function with(): array {
        return [
            'parishes' => Parish::orderBy('name')->get(),
            'user' => Auth::user()
        ];
    }
}; ?>

<div class="space-y-8">
    <!-- Zone Photo Compacte -->
    <div class="flex items-center gap-6">
        <div class="relative group">
            <div class="h-20 w-20 rounded-2xl overflow-hidden border border-slate-200 dark:border-gray-700 bg-slate-50 shadow-sm">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="h-full w-full object-cover">
                @elseif($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="h-full w-full object-cover">
                @elseif($user->avatar)
                    <img src="{{ $user->avatar }}" class="h-full w-full object-cover">
                @else
                    <div class="h-full w-full flex items-center justify-center bg-slate-100 text-slate-400 text-xl font-bold uppercase">
                        {{ substr($name, 0, 1) }}
                    </div>
                @endif
            </div>
            <label class="absolute -bottom-2 -right-2 p-1.5 bg-kamina-blue text-white rounded-lg cursor-pointer shadow-lg hover:scale-110 transition-transform">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke-width="2.5"/></svg>
                <input type="file" wire:model="photo" class="hidden">
            </label>
        </div>
        <div>
            <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-tight">Image de profil</h3>
            <p class="text-xs text-slate-500 mt-0.5">Mettez à jour votre photo d'identité</p>
            <div wire:loading wire:target="photo" class="text-[9px] text-kamina-blue font-black uppercase mt-1 animate-pulse tracking-widest">Envoi...</div>
        </div>
    </div>

    <!-- Grille de formulaire resserrée -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5 pt-4 border-t border-slate-50 dark:border-gray-800">
        <div class="space-y-1.5">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nom complet</label>
            <input type="text" wire:model="name" class="w-full border-slate-200 dark:border-gray-700 dark:bg-gray-800 rounded-xl text-sm focus:ring-kamina-blue focus:border-kamina-blue transition-all">
            @error('name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-1.5">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email</label>
            <input type="email" wire:model="email" class="w-full border-slate-200 dark:border-gray-700 dark:bg-gray-800 rounded-xl text-sm focus:ring-kamina-blue focus:border-kamina-blue transition-all">
            @error('email') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-1.5">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Contact téléphonique</label>
            <input type="text" wire:model="phone" class="w-full border-slate-200 dark:border-gray-700 dark:bg-gray-800 rounded-xl text-sm focus:ring-kamina-blue focus:border-kamina-blue transition-all">
        </div>

        <div class="space-y-1.5">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Paroisse</label>
            <select wire:model="parish_id" class="w-full border-slate-200 dark:border-gray-700 dark:bg-gray-800 rounded-xl text-sm focus:ring-kamina-blue focus:border-kamina-blue transition-all">
                <option value="">Sélectionner votre paroisse</option>
                @foreach($parishes as $parish)
                    <option value="{{ $parish->id }}">{{ $parish->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center gap-4 pt-4">
        <button wire:click="updateProfileInformation" wire:loading.attr="disabled" class="px-6 py-2.5 bg-kamina-blue hover:bg-blue-800 text-white rounded-xl text-[11px] font-black uppercase tracking-widest shadow-md transition-all active:scale-95">
            Enregistrer
        </button>
        <x-action-message on="profile-updated" class="text-xs text-green-600 font-bold uppercase italic animate-pulse">Profil à jour !</x-action-message>
    </div>
</div>