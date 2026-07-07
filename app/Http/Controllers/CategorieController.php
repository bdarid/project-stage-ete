<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        // On charge la relation 'parent' pour afficher le nom de la catégorie parente dans le tableau
        $categories = Categorie::with('parent')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // On récupère toutes les catégories pour le menu déroulant "Catégorie Parente"
        $categories = Categorie::all();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255|unique:categories,nom_categorie',
            'description_categorie' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Categorie::create($request->all());

        return redirect()->route('categories.index')->with('success', 'La catégorie a été créée avec succès.');
    }

    public function show($id)
{
    $categorie = Categorie::with(['sousCategories', 'parent', 'produits'])
        ->findOrFail($id);

    return view('categories.show', compact('categorie'));
}

    public function edit($id)
{
    $categorie = Categorie::findOrFail($id);

    $categories = Categorie::where('id', '!=', $id)->get();

    return view('categories.edit', compact('categorie', 'categories'));
}

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255|unique:categories,nom_categorie,' . $categorie->id,
            'description_categorie' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $categorie->update($request->all());

        return redirect()->route('categories.index')->with('success', 'La catégorie a été mise à jour.');
    }

    public function destroy(Categorie $categorie)
    {
        // Optionnel : vérifier si la catégorie contient des produits ou des sous-catégories avant de supprimer
        if ($categorie->produits()->count() > 0 || $categorie->sousCategories()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette catégorie car elle contient des produits ou des sous-catégories.');
        }

        $categorie->delete();
        return redirect()->route('categories.index')->with('success', 'La catégorie a été supprimée.');
    }
}