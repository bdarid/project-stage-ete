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

        // Si Admin ou Manager, on charge tous les congés avec les infos de l'utilisateur associé
        if ($user->hasRole(['Admin', 'Manager'])) {
            $conges = Conge::with('user')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // L'employé ne voit que ses propres demandes
            $conges = Conge::where('users_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('conges.index', compact('conges'));
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

        return redirect()->back()->with('success', 'Votre demande de congé a été soumise avec succès.');
    }

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
}
