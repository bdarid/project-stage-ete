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

// Redirige l'URL racine (http://127.0.0.1:8000/) vers le dashboard sécurisé
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Toutes les routes ci-dessous nécessitent d'être connecté
Route::middleware(['auth'])->group(function () {

    // Le Dashboard Général (Le carrefour après connexion)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ====================================================
    // MODULES ACCESSIBLES PAR TOUS LES EMPLOYÉS CONNECTÉS
    // ====================================================
    
    // --- Pointage ---
    Route::get('/pointage', [PointageController::class, 'index'])->name('pointage.index');
    Route::post('/pointage/entree', [PointageController::class, 'pointerEntree'])->name('pointage.entree');
    Route::post('/pointage/sortie', [PointageController::class, 'pointerSortie'])->name('pointage.sortie');

    // --- Congés (Actions de l'employé) ---
    Route::get('/conges', [CongeController::class, 'index'])->name('conges');
    Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create'); 
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::get('/conges/{id}/edit', [CongeController::class, 'edit'])->name('conges.edit');
    Route::put('/conges/{id}', [CongeController::class, 'update'])->name('conges.update');
    Route::delete('/conges/{id}', [CongeController::class, 'destroy'])->name('conges.destroy');

    // --- Tâches (Visualisation et mise à jour par l'employé) ---
    Route::get('/taches', [TacheController::class, 'index'])->name('taches.index');
    Route::put('/taches/{id}/statut', [TacheController::class, 'updateStatut'])->name('taches.statut');


    // ====================================================
    // MODULES RÉSERVÉS UNIQUEMENT AUX ADMINS & MANAGERS
    // ====================================================
    Route::middleware(['role:Admin|Manager'])->group(function () {

        // --- Validation des congés ---
        Route::put('/conges/{id}/valider', [CongeController::class, 'updateStatut'])->name('conges.valider');

        // --- Attribution de tâches ---
        Route::post('/taches', [TacheController::class, 'store'])->name('taches.store');

        // --- Gestion des Produits et Ventes (CRUD complet via Resources) ---
        Route::resource('produits', ProduitController::class);
        Route::resource('ventes', VenteController::class);

        // --- Gestion des Utilisateurs / Employés ---
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    });
});

require __DIR__.'/auth.php';