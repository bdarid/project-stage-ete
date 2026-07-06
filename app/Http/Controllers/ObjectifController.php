<?php

namespace App\Http\Controllers;

use App\Models\Objectif;
use App\Models\Users;
use App\Models\Departements;
use Illuminate\Http\Request;

class ObjectifController extends Controller
{
    /**
     * Afficher tous les objectifs
     */
    public function index()
    {
        $objectifs = Objectif::with(['users', 'departement'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('objectifs.index', compact('objectifs'));
    }

    /**
     * Formulaire d'ajout
     */
    public function create()
    {
        $users = Users::all();
        $departements = Departements::all();

        return view('objectifs.create', compact('users', 'departements'));
    }

    /**
     * Enregistrer un objectif
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre_objectif' => 'required|string|max:255',
            'description_objectif' => 'required|string',
            'date_debut_obj' => 'nullable|date',
            'date_fin_obj' => 'nullable|date|after_or_equal:date_debut_obj',
            'etat_avancement_objectif' => 'required|integer|min:0|max:100',
            'file_json' => 'nullable|array',
        ]);

        $objectif = Objectif::create([
            'titre_objectif' => $request->titre_objectif,
            'description_objectif' => $request->description_objectif,
            'date_debut_obj' => $request->date_debut_obj,
            'date_fin_obj' => $request->date_fin_obj,
            'etat_avancement_objectif' => $request->etat_avancement_objectif,
            'file_json' => $request->file_json ?? [],
        ]);

        // Affecter les employés
        if ($request->filled('users')) {
            $objectif->users()->sync($request->users);
        }

        // Affecter les départements
        if ($request->filled('departements')) {
            $objectif->departement()->sync($request->departements);
        }

        return redirect()->route('objectifs.index')
            ->with('success', 'Objectif créé avec succès.');
    }

    /**
     * Afficher un objectif
     */
    public function show(Objectif $objectif)
    {
        $objectif->load(['users', 'departement']);

        return view('objectifs.show', compact('objectif'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(Objectif $objectif)
    {
        $users = Users::all();
        $departements = Departements::all();

        return view('objectifs.edit', compact(
            'objectif',
            'users',
            'departements'
        ));
    }

    /**
     * Mettre à jour un objectif
     */
    public function update(Request $request, Objectif $objectif)
    {
        $request->validate([
            'titre_objectif' => 'required|string|max:255',
            'description_objectif' => 'required|string',
            'date_debut_obj' => 'nullable|date',
            'date_fin_obj' => 'nullable|date|after_or_equal:date_debut_obj',
            'etat_avancement_objectif' => 'required|integer|min:0|max:100',
            'file_json' => 'nullable|array',
        ]);

        $objectif->update([
            'titre_objectif' => $request->titre_objectif,
            'description_objectif' => $request->description_objectif,
            'date_debut_obj' => $request->date_debut_obj,
            'date_fin_obj' => $request->date_fin_obj,
            'etat_avancement_objectif' => $request->etat_avancement_objectif,
            'file_json' => $request->file_json ?? [],
        ]);

        $objectif->users()->sync($request->users ?? []);
        $objectif->departement()->sync($request->departements ?? []);

        return redirect()->route('objectifs.index')
            ->with('success', 'Objectif mis à jour avec succès.');
    }

    /**
     * Supprimer un objectif
     */
    public function destroy(Objectif $objectif)
    {
        $objectif->users()->detach();
        $objectif->departement()->detach();

        $objectif->delete();

        return redirect()->route('objectifs.index')
            ->with('success', 'Objectif supprimé avec succès.');
    }
}