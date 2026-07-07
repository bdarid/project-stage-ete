<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use App\Models\Users;
use App\Models\Objectif;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
{
    // Récupère les départements paginés tout en comptant les relations en une seule requête SQL
    $departements = Departements::withCount(['users', 'objectifs'])->paginate(10);

    return view('departements.index', compact('departements'));
}
    

    public function create()
    {
        $users = Users::all();
        $objectifs = Objectif::all();

        return view('departements.create', compact('users', 'objectifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_departement' => 'required|string|max:255',
            'users' => 'nullable|array',
            'objectifs' => 'nullable|array',
        ]);

        $departement = Departements::create([
            'nom_departement' => $request->nom_departement,
            'nbre_employes' => count($request->users ?? []),
        ]);

        if ($request->filled('users')) {
            $departement->users()->sync($request->users);
        }

        if ($request->filled('objectifs')) {
            $departement->objectifs()->sync($request->objectifs);
        }

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département créé avec succès.');
    }

    public function show(Departements $departement)
    {
        $departement->load(['users', 'objectifs']);

        return view('departements.show', compact('departement'));
    }

    public function edit(Departements $departement)
    {
        $users = Users::all();
        $objectifs = Objectif::all();

        return view('departements.edit', compact(
            'departement',
            'users',
            'objectifs'
        ));
    }

    public function update(Request $request, Departements $departement)
    {
        $request->validate([
            'nom_departement' => 'required|string|max:255',
            'users' => 'nullable|array',
            'objectifs' => 'nullable|array',
        ]);

        $departement->update([
            'nom_departement' => $request->nom_departement,
            'nbre_employes' => count($request->users ?? []),
        ]);

        $departement->users()->sync($request->users ?? []);
        $departement->objectifs()->sync($request->objectifs ?? []);

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département modifié avec succès.');
    }

    public function destroy(Departements $departement)
    {
        $departement->delete();

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département supprimé avec succès.');
    }
}