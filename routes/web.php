<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- MIDDLEWARES ---
use App\Http\Middleware\EnsureUserIsActive;

// --- IMPORTS COMPOSANTS ADMIN ---
use App\Livewire\Admin\Articles\ArticleIndex;
use App\Livewire\Admin\Categories\CategoryIndex;
use App\Livewire\Admin\Documents\DocumentIndex;
use App\Livewire\Admin\Parishes\ParishIndex;
use App\Livewire\Admin\Users\UserIndex;
use App\Livewire\Admin\Songs\SongIndex;
use App\Livewire\Admin\Settings\SettingsIndex;
use App\Livewire\Admin\Clergy\ClergyManager;

// --- IMPORTS COMPOSANTS PUBLIC ---
use App\Livewire\Public\Home;
use App\Livewire\Public\News\ArticleList;
use App\Livewire\Public\News\ArticleShow;
use App\Livewire\Public\Resources\DocumentList;
use App\Livewire\Public\Resources\DocumentShow;
use App\Livewire\Public\Info\Presentation;
use App\Livewire\Public\Info\Contact;
use App\Livewire\Public\Parishes\ParishList;
use App\Livewire\Public\Parishes\ParishDetail;
use App\Livewire\Public\Liturgy\SongLibrary;
use App\Livewire\Public\Donation;
use App\Http\Controllers\DownloadController;

// --- IMPORTS POUR GOOGLE AUTHENTICATION ---
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/
Route::get('/', Home::class)->name('home');
Route::get('/actualites', ArticleList::class)->name('news.index');
Route::get('/actualites/{slug}', ArticleShow::class)->name('news.show');
Route::get('/presentation', Presentation::class)->name('presentation');
Route::get('/documents', DocumentList::class)->name('documents.public.index');
Route::get('/documents/{id}', DocumentShow::class)->name('documents.public.show');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/paroisses', ParishList::class)->name('parishes.public.index');
Route::get('/paroisses/{id}', ParishDetail::class)->name('parishes.public.show');
Route::get('/liturgie', SongLibrary::class)->name('liturgy.public.index');
Route::get('/don', Donation::class)->name('donation');

Route::get('/download/song/{id}/{type}', [DownloadController::class, 'downloadSong'])
    ->name('download.song')
    ->where('type', 'audio|score');

/*
|--------------------------------------------------------------------------
| ROUTES ADMIN (Protégées par auth, is_active et is_admin)
|--------------------------------------------------------------------------
*/
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', EnsureUserIsActive::class, 'is_admin']) 
    ->name('dashboard');

Route::middleware(['auth', 'verified', EnsureUserIsActive::class, 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    
    Route::get('/articles', ArticleIndex::class)->name('articles.index');
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/documents', DocumentIndex::class)->name('documents.index');
    Route::get('/parishes', ParishIndex::class)->name('parishes.index');
    Route::get('/songs', SongIndex::class)->name('songs.index');
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/settings', SettingsIndex::class)->name('settings.index');

    Route::get('/clergy', ClergyManager::class)
        ->middleware('can:manage-clergy')
        ->name('clergy.index');
});

/*
|--------------------------------------------------------------------------
| PROFIL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION GOOGLE
|--------------------------------------------------------------------------
*/
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')->user();
        
        $user = User::where('google_id', $googleUser->id)
                    ->orWhere('email', $googleUser->email)
                    ->first();

        if ($user) {
            $user->update([
                'google_id' => $googleUser->id,
                'avatar' => $user->avatar ?? $googleUser->avatar, 
            ]);
        } else {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => Hash::make(Str::random(24)),
                'role' => 'user', 
                'is_active' => true,
            ]);
        }

        Auth::login($user);
        
        return $user->role === 'user' ? redirect('/') : redirect()->intended('/dashboard');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Erreur Google');
    }
});

require __DIR__.'/auth.php';