<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conge;
use Carbon\Carbon;

class CongeController extends Controller
{
    // 1. Afficher la liste des congés
    public function index()
{
    $user = Auth::user();

    if ($user->hasRole(['Admin', 'Manager'])) {

        $conges = Conge::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

    } else {

        $conges = Conge::where('users_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

    }

    return view('conge.index', compact('conges'));
}

    // 2. Soumettre une demande de congé (Employé)
    public function store(Request $request)
    {
        // Validation stricte des dates et types selon votre énum de migration
        $request->validate([
            'date_debut' => 'required|date|before_or_equal:date_fin',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'type_conge' => 'required|in:annuel,maladie,jours_ferie,conge_de_maternite',
        ]);

        $user = Auth::user();

        // Calcul du nombre de jours demandés (calqué sur le DATEDIFF de votre base)
        $debut = Carbon::parse($request->date_debut);
        $fin = Carbon::parse($request->date_fin);
        $joursDemandes = $debut->diffInDays($fin); // DATEDIFF(en jours)

        // Calcul du solde actuel disponible de l'employé
        $joursConsommes = Conge::where('users_id', $user->id)
            ->where('reponse', 'accepte')
            ->sum('duree');

        $soldeDisponible = 30 - $joursConsommes;

        // Vérification de la cohérence du solde
        if ($soldeDisponible < $joursDemandes) {
            return redirect()->back()->withErrors([
                'solde' => "Solde insuffisant. Vous demandez $joursDemandes jour(s) mais il ne vous reste que $soldeDisponible jour(s)."
            ])->withInput();
        }

        // Insertion propre via Eloquent
        Conge::create([
            'users_id'   => $user->id,
            'date_debut' => $request->date_debut,
            'date_fin'   => $request->date_fin,
            'solde'      => $soldeDisponible, // Enregistre le solde au moment de la demande
            'statut'     => 'en attente',     // En minuscule, comme dans votre migration
            'type_conge' => $request->type_conge,
        ]);

        return redirect()->route('conges')->with('success', 'Demande de congé créée avec succès.');    }

    // 3. Valider ou Refuser un congé (Admin / Manager uniquement)
    public function updateStatut(Request $request, $id)
    {
        // Validation calquée sur votre colonne 'reponse' de la migration
        $request->validate([
            'reponse' => 'required|in:accepte,refuse'
        ]);

        $conge = Conge::findOrFail($id);

        // Si accepté, on passe le statut 'en cours' ou on le laisse gérer par l'administration
        $statut = $request->reponse === 'accepte' ? 'en cours' : 'hors conge';

        $conge->update([
            'reponse' => $request->reponse,
            'statut'  => $statut,
        ]);

        return redirect()->back()->with('success', 'La réponse au congé a bien été enregistrée.');
    }
    public function destroy($id)
{
    $conge = Conge::findOrFail($id);

    // Un employé ne peut supprimer que ses propres demandes
    if (!Auth::user()->hasRole(['Admin', 'Manager']) && $conge->users_id != Auth::id()) {
        abort(403);
    }

    $conge->delete();

    return redirect()
        ->route('conges')
        ->with('success', 'La demande de congé a été supprimée.');
}
public function update(Request $request, $id)
{
    $request->validate([
        'date_debut' => 'required|date|before_or_equal:date_fin',
        'date_fin'   => 'required|date|after_or_equal:date_debut',
        'type_conge' => 'required|in:annuel,maladie,jours_ferie,conge_de_maternite',
    ]);

    $conge = Conge::findOrFail($id);

    if (!Auth::user()->hasRole(['Admin', 'Manager']) && $conge->users_id != Auth::id()) {
        abort(403);
    }

    $conge->update([
        'date_debut' => $request->date_debut,
        'date_fin'   => $request->date_fin,
        'type_conge' => $request->type_conge,
    ]);

    return redirect()
        ->route('conges')
        ->with('success', 'La demande de congé a été modifiée.');
}
public function edit($id)
{
    $conge = Conge::findOrFail($id);

    // Un employé ne peut modifier que ses propres demandes
    if (!Auth::user()->hasRole(['Admin', 'Manager']) && $conge->users_id != Auth::id()) {
        abort(403);
    }

    return view('conge.edit', compact('conge'));
}
public function create()
{
    return view('conge.create');
}
}
