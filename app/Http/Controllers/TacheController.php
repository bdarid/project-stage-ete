<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Users; 

class TacheController extends Controller
{
    // Afficher la liste des tâches (Admin ou Employé)
    public function index(Request $request)
    {
        // ... (votre code index actuel)
        $user = Auth::user();

        $query = DB::table('taches')
            ->leftJoin('user_taches', 'taches.id', '=', 'user_taches.taches_id')
            ->leftJoin('users', 'user_taches.users_id', '=', 'users.id')
            ->select('taches.*', 'users.name_users as employe_nom');

        if ($request->filled('status')) {
            $query->where('taches.statut', $request->status);
        }

        if ($request->filled('priorite')) {
            $query->where('taches.priorite', $request->priorite);
        }

        if ($user->hasRole('Admin')) {
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('taches.titre_taches', 'like', "%{$search}%")
                      ->orWhere('users.name_users', 'like', "%{$search}%");
                });
            }

            $taches = $query->orderBy('taches.created_at', 'desc')->paginate(10)->withQueryString();
            return view('taches.admin', compact('taches'));
        }

        $query->where('user_taches.users_id', $user->id);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('taches.titre_taches', 'like', "%{$search}%")
                  ->orWhere('taches.description_taches', 'like', "%{$search}%");
            });
        }

        $taches = $query->orderBy('taches.created_at', 'desc')->paginate(10)->withQueryString();
        return view('taches.employe', compact('taches'));
    }

    // --- NOUVELLE MÉTHODE AJOUTÉE ICI ---
    public function show($id)
    {
        $tache = DB::table('taches')->where('id', $id)->first();

        if (!$tache) {
            abort(404, 'Tâche non trouvée.');
        }

        return view('taches.show', compact('tache'));
    }

    public function destroy($id)
    {
        DB::table('user_taches')->where('taches_id', $id)->delete();
        DB::table('taches')->where('id', $id)->delete();
        return redirect()->route('taches.index')->with('success', 'Tâche supprimée avec succès.');
    }

    public function create()
    {
        $employes = Users::all();
        return view('taches.create', compact('employes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre_taches' => 'required|string|max:255',
            'description_taches' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'priorite' => 'required|in:basse,haute,urgent',
            'user_id' => 'required|exists:users,id',
        ]);

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
            'priorite' => $request->priorite,
        ]);

        DB::table('user_taches')->insert([
            'taches_id' => $tacheId,
            'users_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('taches.index')->with('success', 'Tâche assignée avec succès !');
    }

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

    public function edit($id)
    {
        $tache = DB::table('taches')->where('id', $id)->first();
        $employes = \App\Models\Users::all();
        $affectation = DB::table('user_taches')->where('taches_id', $id)->first();

        return view('taches.edit', compact('tache', 'employes', 'affectation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre_taches' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'priorite' => 'required|in:haute,basse,urgent',
        ]);

        DB::table('taches')->where('id', $id)->update([
            'titre_taches' => $request->titre_taches,
            'description_taches' => $request->description_taches,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'priorite' => $request->priorite,
            'updated_at' => now(),
        ]);

        DB::table('user_taches')->where('taches_id', $id)->update([
            'users_id' => $request->user_id,
        ]);

        return redirect()->route('taches.index')->with('success', 'Tâche modifiée avec succès !');
    }
}