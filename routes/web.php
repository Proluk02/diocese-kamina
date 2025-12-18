<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- IMPORT DU MIDDLEWARE DE SÉCURITÉ ---
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
| ROUTES ADMIN (Protégées)
|--------------------------------------------------------------------------
*/

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', EnsureUserIsActive::class]) // Sécurité active ajoutée
    ->name('dashboard');

// Groupe Administration
// Le middleware EnsureUserIsActive bloque les utilisateurs dont is_active = false (ex: musiciens en attente)
Route::middleware(['auth', 'verified', EnsureUserIsActive::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    
    // Contenu (Tout le monde peut voir, les permissions gèrent l'écriture)
    Route::get('/articles', ArticleIndex::class)->name('articles.index');
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/documents', DocumentIndex::class)->name('documents.index');

    // Structures & Liturgie
    Route::get('/parishes', ParishIndex::class)->name('parishes.index');
    Route::get('/songs', SongIndex::class)->name('songs.index');

    // Administration Système (À protéger via Gate dans le composant)
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

require __DIR__.'/auth.php';