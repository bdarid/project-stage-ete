<?php

use App\Http\Controllers\AchatController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObjectifController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Si l'utilisateur est déjà connecté, on l'envoie au Dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Sinon, on le force à se connecter
    return redirect()->route('login');
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

    // --- Tâches (Lecture et MAJ du statut par l'employé) ---
    Route::get('/taches', [TacheController::class, 'index'])->name('taches.index');
    Route::patch('/taches/{id}/statut', [TacheController::class, 'updateStatut'])->name('taches.updateStatut');
    
    // --- Création de produit et consulter le stock ---
    Route::resource('produits', ProduitController::class);

    //objectif
    Route::resource('objectifs', ObjectifController::class);
    //stock
    Route::resource('stocks', StockController::class);
    //achat
    Route::resource('achats', AchatController::class);



    // ====================================================
    // MODULES RÉSERVÉS UNIQUEMENT AUX ADMINS & MANAGERS
    // ====================================================
    Route::middleware(['role:Admin|Manager'])->group(function () {

        // --- Validation des congés ---
        Route::put('/conges/{id}/valider', [CongeController::class, 'updateStatut'])->name('conges.valider');

        // --- Tâches (Création et assignation uniquement par l'Admin/Manager) ---
        Route::get('/taches/create', [TacheController::class, 'create'])->name('taches.create');
        Route::post('/taches', [TacheController::class, 'store'])->name('taches.store');

        // --- Gestion des Ventes ---
        Route::resource('ventes', VenteController::class);

        // --- Gestion des Utilisateurs / Employés ---
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Pointage admin
        Route::get('/admin/pointages', [App\Http\Controllers\PointageController::class, 'adminIndex'])->name('pointages.adminindex');

    });
});

require __DIR__.'/auth.php';