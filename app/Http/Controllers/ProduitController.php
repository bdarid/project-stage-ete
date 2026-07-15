<?php
namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;

class ProduitController extends Controller
{
// ==========================================
// 1. MÉTHODE INDEX : Afficher la liste (Celle qui manquait !)
// ==========================================
public function index()
{
// On récupère tous les produits
$produits = Produit::with('user')
    ->orderBy('created_at', 'desc')
    ->paginate(10);

// Petite logique pour l'alerte de stock (Produits dont la quantité < 5)
$alertesStock = Produit::where('quantite_produit', '<', 5)->get();

return view('produits.index', compact('produits', 'alertesStock'));
}

// ==========================================
// 2. MÉTHODE CREATE : Afficher le formulaire d'ajout
// ==========================================
public function create()
{
    $categories = Categorie::orderBy('nom_categorie')->get();

    return view('produits.create', compact('categories'));
}

// ==========================================
// 3. MÉTHODE STORE : Enregistrer dans la base de données
// ==========================================
public function store(Request $request)
{
// 1. Validation de tous les champs obligatoires
$validated = $request->validate([
'reference' => 'required|string|unique:produits,reference|max:255',
'nom_produit' => 'required|string|max:255',
'description_produit' => 'nullable|string',
'quantite_produit' => 'required|integer|min:0',
'date_expiration' => 'required|date',
'prix_achat_moy' => 'required|numeric|min:0',
'prix_vente_moy' => 'required|numeric|min:0',
'categorie_id' => 'required|exists:categories,id'
]);

// 2. Ajout des champs automatiques
$validated['users_id'] = Auth::id();
$validated['stock_actuel'] = $validated['quantite_produit'];

// 3. Création du produit
Produit::create($validated);

return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
}
// ==========================================
    // 4. MÉTHODE EDIT : Afficher le formulaire de modification
    // ==========================================
    public function edit($id)
{
    $produit = Produit::findOrFail($id);
    $categories = Categorie::orderBy('nom_categorie')->get();

    return view('produits.edit', compact('produit', 'categories'));
}

    // ==========================================
    // 5. MÉTHODE UPDATE : Enregistrer les modifications
    // ==========================================
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $validated = $request->validate([
            // L'astuce ici : on dit à Laravel de vérifier que la référence est unique,
            // SAUF pour le produit qu'on est en train de modifier !
            'reference' => 'required|string|max:255|unique:produits,reference,' . $produit->id,
            'nom_produit' => 'required|string|max:255',
            'description_produit' => 'nullable|string',
            'quantite_produit' => 'required|integer|min:0',
            'date_expiration' => 'required|date',
            'prix_achat_moy' => 'required|numeric|min:0',
            'prix_vente_moy' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        // Mise à jour du stock actuel
        $validated['stock_actuel'] = $validated['quantite_produit'];

        // On met à jour la ligne dans la base de données
        $produit->update($validated);

        return redirect()->route('produits.index')->with('success', 'Le produit a été modifié avec succès.');
    }

    // ==========================================
    // 6. MÉTHODE DESTROY : Supprimer le produit
    // ==========================================
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Le produit a été supprimé de la base de données.');
    }
}
