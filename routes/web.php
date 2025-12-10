<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Public\Resources\DocumentShow;
use App\Livewire\Public\Donation;

// --- BACK-OFFICE (ADMIN) ---
use App\Livewire\Admin\Articles\ArticleIndex;
use App\Livewire\Admin\Categories\CategoryIndex;
use App\Livewire\Admin\Documents\DocumentIndex;
use App\Livewire\Admin\Parishes\ParishIndex;
use App\Livewire\Admin\Users\UserIndex;
use App\Livewire\Admin\Songs\SongIndex;

// --- FRONT-OFFICE (PUBLIC) ---
use App\Livewire\Public\Home;
use App\Livewire\Public\News\ArticleList;
use App\Livewire\Public\News\ArticleShow;
use App\Livewire\Public\Resources\DocumentList;
use App\Livewire\Public\Info\Presentation;
use App\Livewire\Public\Info\Contact;
use App\Livewire\Public\Parishes\ParishList;
use App\Livewire\Public\Parishes\ParishDetail;
use App\Livewire\Public\Liturgy\SongLibrary; 


// 1. PAGE D'ACCUEIL
Route::get('/', Home::class)->name('home');

// 2. ACTUALITÉS (Module A)
Route::get('/actualites', ArticleList::class)->name('news.index'); // Nom adapté
Route::get('/actualites/{slug}', ArticleShow::class)->name('news.show');

// 3. PAROISSES (Module B)
Route::get('/paroisses', ParishList::class)->name('parishes.public.index'); // Nom adapté
Route::get('/paroisses/{id}', ParishDetail::class)->name('public.parishes.show'); 

// 4. LITURGIE & CHANTS (Module B)
Route::get('/chantier-liturgique', SongLibrary::class)->name('liturgy.public.index'); 

Route::get('/documents', DocumentList::class)->name('documents.public.index'); 
Route::get('/documents/{id}', DocumentShow::class)->name('documents.public.show');

// 6. PAGES INSTITUTIONNELLES (Module A)
Route::get('/presentation', Presentation::class)->name('presentation'); 
Route::get('/contact', Contact::class)->name('contact'); // Nom adapté

// 7. DIVERS
Route::get('/don', Donation::class)->name('public.donation');


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

    // Paramètres (Page placeholder)
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