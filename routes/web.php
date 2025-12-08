<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Articles\ArticleIndex;
use App\Livewire\Admin\Categories\CategoryIndex;
use App\Livewire\Admin\Documents\DocumentIndex;
use App\Livewire\Admin\Parishes\ParishIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- ZONE D'ADMINISTRATION ---
// Ces routes servent de "placeholders" pour éviter l'erreur RouteNotFound
// Nous créerons les vrais composants Livewire pour chaque page à l'étape suivante.
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route: admin.articles.index
    Route::get('/articles', function () {
        return view('dashboard'); // Temporaire
    })->name('articles.index');

    // Route: admin.categories.index
    Route::get('/categories', function () {
        return view('dashboard'); // Temporaire
    })->name('categories.index');

    // Route: admin.documents.index
    Route::get('/documents', function () {
        return view('dashboard'); // Temporaire
    })->name('documents.index');

    // Route: admin.users.index
    Route::get('/users', function () {
        return view('dashboard'); // Temporaire
    })->name('users.index');

    // Route: admin.settings.index
    Route::get('/settings', function () {
        return view('dashboard'); // Temporaire
    })->name('settings.index');

    Route::get('/articles', ArticleIndex::class)->name('articles.index');
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/documents', DocumentIndex::class)->name('documents.index');
    Route::get('/parishes', ParishIndex::class)->name('parishes.index');
});

// --- GESTION DU PROFIL ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';