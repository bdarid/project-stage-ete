<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Toutes les routes à l'intérieur nécessitent d'être connecté (Middleware 'auth')
Route::middleware(['auth'])->group(function () {

    // Le Dashboard Général (Le contrôleur fera le tri selon le rôle)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ==========================================
    // MODULE RH (Accessible par tous les employés)
    // ==========================================
    Route::get('/pointage', [PointageController::class, 'index'])->name('pointage.index');
    Route::post('/pointage/entree', [PointageController::class, 'pointerEntree'])->name('pointage.entree');
    Route::post('/pointage/sortie', [PointageController::class, 'pointerSortie'])->name('pointage.sortie');

    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');

    Route::get('/taches', [TacheController::class, 'index'])->name('taches.index');
    Route::put('/taches/{id}/statut', [TacheController::class, 'updateStatut'])->name('taches.statut');

    // ==========================================
    // MODULES ADMIN & MANAGER (Sécurité SPATIE)
    // ==========================================
    // Ces routes sont protégées : si un simple employé essaie d'y aller, il aura une erreur 403.
    Route::middleware(['role:Admin|Manager'])->group(function () {

        // Validation des congés
        Route::put('/conges/{id}/valider', [CongeController::class, 'updateStatut'])->name('conges.valider');

        // Création de tâches pour les employés
        Route::post('/taches', [TacheController::class, 'store'])->name('taches.store');

        // Gestion complète des Produits et Ventes (Ressources CRUD)
        Route::resource('produits', ProduitController::class);
        Route::resource('ventes', VenteController::class);
        //visualiser les employes et ajouter
        // Liste des employés
        Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Formulaire de création et enregistrement
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Formulaire de modification (lié au bouton Modifier du Canvas)
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
     // Enregistrement des modifications
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    });
});

require __DIR__.'/auth.php';
