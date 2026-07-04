<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Users; // Utilisation correcte de ton modèle Users

class TacheController extends Controller
{
    // Afficher la liste des tâches (Admin ou Employé)
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            // L'admin voit toutes les tâches avec les colonnes exactes : taches_id et users_id
            $taches = DB::table('taches')
                ->leftJoin('user_taches', 'taches.id', '=', 'user_taches.taches_id')
                ->leftJoin('users', 'user_taches.users_id', '=', 'users.id')
                ->select('taches.*', 'users.name_users as employe_nom')
                ->orderBy('taches.created_at', 'desc')
                ->get();

            return view('taches.admin', compact('taches'));
        }

        // L'employé voit uniquement ses tâches avec le bon nom de colonne taches_id et users_id
        $mesTaches = DB::table('taches')
            ->join('user_taches', 'taches.id', '=', 'user_taches.taches_id')
            ->where('user_taches.users_id', $user->id)
            ->select('taches.*')
            ->orderBy('taches.created_at', 'desc')
            ->get();

        return view('taches.employe', compact('mesTaches'));
    }

    // Afficher le formulaire de création (Admin/Manager)
    public function create()
    {
        $employes = Users::all(); // Utilisation de ton modèle personnalisé Users
        return view('taches.create', compact('employes'));
    }

    // Créer une nouvelle tâche dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'titre_taches' => 'required|string|max:255',
            'description_taches' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id',
        ]);

        // 1. Création de la tâche dans la table 'taches'
        $tacheId = DB::table('taches')->insertGetId([
            'titre_taches' => $request->titre_taches,
            'description_taches' => $request->description_taches,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'en cours',
            'justif_retard_tache' => '-',
            'type_justif' => 'accepte',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Liaison dans la table pivot avec les colonnes réelles : taches_id et users_id
        DB::table('user_taches')->insert([
            'taches_id' => $tacheId,
            'users_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('taches.index')->with('success', 'Tâche assignée avec succès !');
    }

    // Mettre à jour l'état d'une tâche (Employé)
    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en cours,fini,en retard'
        ]);

        DB::table('taches')->where('id', $id)->update([
            'statut' => $request->statut,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour !');
    }
}
