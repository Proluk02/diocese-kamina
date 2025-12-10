<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- IMPORTS COMPOSANTS ADMIN (Back-Office) ---
use App\Livewire\Admin\Articles\ArticleIndex;
use App\Livewire\Admin\Categories\CategoryIndex;
use App\Livewire\Admin\Documents\DocumentIndex;
use App\Livewire\Admin\Parishes\ParishIndex;
use App\Livewire\Admin\Users\UserIndex;
use App\Livewire\Admin\Songs\SongIndex;

// --- IMPORTS COMPOSANTS PUBLIC (Site Vitrine) ---
use App\Livewire\Public\Home;
use App\Livewire\Public\News\ArticleList;
use App\Livewire\Public\News\ArticleShow;
use App\Livewire\Public\Resources\DocumentList;
use App\Livewire\Public\Resources\DocumentShow;
use App\Livewire\Public\Info\Presentation;
use App\Livewire\Public\Info\Contact;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (Accessibles à tous)
|--------------------------------------------------------------------------
*/

// 1. PAGE D'ACCUEIL
Route::get('/', Home::class)->name('home');

// 2. ACTUALITÉS
Route::get('/actualites', ArticleList::class)->name('news.index');
Route::get('/actualites/{slug}', ArticleShow::class)->name('news.show');

// 3. INSTITUTIONNEL & RESSOURCES (Module A)
Route::get('/presentation', Presentation::class)->name('presentation');

Route::get('/documents', DocumentList::class)->name('documents.public.index');
Route::get('/documents/{id}', DocumentShow::class)->name('documents.public.show');
Route::get('/contact', Contact::class)->name('contact');

// 4. MODULE B (Placeholders en attendant le développement)
// Ces routes permettent aux liens du menu de fonctionner sans erreur 404
Route::get('/paroisses', function() { return view('coming-soon', ['title' => 'Paroisses']); })->name('parishes.public.index');
Route::get('/liturgie', function() { return view('coming-soon', ['title' => 'Chants & Liturgie']); })->name('liturgy.public.index');
Route::get('/don', function() { return view('coming-soon', ['title' => 'Faire un Don']); })->name('donation');

/*
|--------------------------------------------------------------------------
| ROUTES ADMIN (Protégées par auth)
|--------------------------------------------------------------------------
*/

// Tableau de bord principal
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Groupe Administration
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Gestion de Contenu
    Route::get('/articles', ArticleIndex::class)->name('articles.index');
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/documents', DocumentIndex::class)->name('documents.index');

    // Structures & Liturgie
    Route::get('/parishes', ParishIndex::class)->name('parishes.index');
    Route::get('/songs', SongIndex::class)->name('songs.index');

    // Administration Système
    Route::get('/users', UserIndex::class)->name('users.index');

    // Paramètres (Page placeholder en attendant le développement)
    Route::get('/settings', function () {
        return view('dashboard'); 
    })->name('settings.index');
});

/*
|--------------------------------------------------------------------------
| GESTION DU PROFIL UTILISATEUR
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';