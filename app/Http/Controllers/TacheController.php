<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Users; // On utilise bien ta classe Users

class TacheController extends Controller
{
    // Afficher le Kanban ou la liste des tâches
    public function index()
    {
        $user = Auth::user();

        // Si l'utilisateur a le rôle Admin, il voit toutes les tâches
        if ($user->hasRole('Admin')) {
            $taches = DB::table('taches')->get();
            $employes = Users::all(); // Pour le menu déroulant d'assignation
            return view('taches.admin', compact('taches', 'employes'));
        }

        // Sinon, l'employé voit uniquement les tâches qui lui sont assignées
        // (En passant par la table pivot user_taches)
        $mesTaches = DB::table('taches')
            ->join('user_taches', 'taches.id', '=', 'user_taches.tache_id')
            ->where('user_taches.user_id', $user->id)
            ->select('taches.*')
            ->get();

        return view('taches.employe', compact('mesTaches'));
    }

    // Créer une nouvelle tâche (Admin/Manager)
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id', // L'employé assigné
        ]);

        // 1. Créer la tâche
        $tacheId = DB::table('taches')->insertGetId([
            'titre' => $request->titre,
            'description' => $request->description,
            'statut' => 'À faire',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Lier la tâche à l'employé dans la table pivot
        DB::table('user_taches')->insert([
            'user_id' => $request->user_id,
            'tache_id' => $tacheId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Tâche assignée avec succès.');
    }

    // Mettre à jour l'état d'une tâche (Employé)
    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:À faire,En cours,Terminé'
        ]);

        DB::table('taches')->where('id', $id)->update([
            'statut' => $request->statut,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Statut de la tâche mis à jour.');
    }
}
