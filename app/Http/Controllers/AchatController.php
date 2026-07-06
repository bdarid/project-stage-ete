<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Stock;
use App\Models\Users;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    /**
     * Afficher tous les achats
     */
    public function index()
    {
        $achats = Achat::with([
            'produit',
            'categorie',
            'users'
        ])->latest()->paginate(10);

        return view('achats.index', compact('achats'));
    }

    /**
     * Formulaire de création
     */
    public function create()
{
    return view('achats.create', [
        'produits' => Produit::with('categorie')->get(),
        'users' => Users::all(),
    ]);
}

    /**
     * Enregistrer un achat
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produits_id' => 'required|exists:produits,id',
            'categorie_id' => 'required|exists:categories,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'nom_fournisseur' => 'required|string|max:255',
            'date_achat' => 'required|date',
            'quantite' => 'required|integer|min:1',
            'users_id' => 'required|exists:users,id',
            'commentaire' => 'nullable|string',
        ]);

        $achat = Achat::create($validated);

        $produit = Produit::findOrFail($request->produits_id);

        $produit->quantite_produit += $request->quantite;
        $produit->stock_actuel += $request->quantite;
        $produit->prix_achat_moy = $request->prix_achat;
        $produit->prix_vente_moy = $request->prix_vente;
        $produit->save();

        Stock::create([
            'produits_id' => $produit->id,
            'categorie_id' => $request->categorie_id,
            'mouvement_stock' => $request->quantite,
            'achat_id' => $achat->id,
            'vente_id' => null,
            'users_id' => $request->users_id,
        ]);

        return redirect()
            ->route('achats.index')
            ->with('success', 'Achat enregistré avec succès.');
    }

    /**
     * Afficher un achat
     */
    public function show(Achat $achat)
    {
        $achat->load([
            'produit',
            'categorie',
            'users'
        ]);

        return view('achats.show', compact('achat'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(Achat $achat)
    {
        return view('achats.edit', [
            'achat' => $achat,
            'produits' => Produit::all(),
            'categories' => Categorie::all(),
            'users' => Users::all(),
        ]);
    }

    /**
     * Modifier un achat
     */
    public function update(Request $request, Achat $achat)
{
    $validated = $request->validate([
        'produits_id' => 'required|exists:produits,id',
        'categorie_id' => 'required|exists:categories,id',
        'prix_achat' => 'required|numeric|min:0',
        'prix_vente' => 'required|numeric|min:0',
        'nom_fournisseur' => 'required|string|max:255',
        'date_achat' => 'required|date',
        'quantite' => 'required|integer|min:1',
        'users_id' => 'required|exists:users,id',
        'commentaire' => 'nullable|string',
    ]);

    $produit = Produit::findOrFail($achat->produits_id);

    /*
    |--------------------------------------
    | On retire l'ancienne quantité
    |--------------------------------------
    */

    $produit->quantite_produit -= $achat->quantite;
    $produit->stock_actuel -= $achat->quantite;

    /*
    |--------------------------------------
    | On ajoute la nouvelle quantité
    |--------------------------------------
    */

    $produit->quantite_produit += $request->quantite;
    $produit->stock_actuel += $request->quantite;

    $produit->prix_achat_moy = $request->prix_achat;
    $produit->prix_vente_moy = $request->prix_vente;

    $produit->save();

    /*
    |--------------------------------------
    | Mise à jour de l'achat
    |--------------------------------------
    */

    $achat->update($validated);

    /*
    |--------------------------------------
    | Mise à jour du mouvement de stock
    |--------------------------------------
    */

    $stock = Stock::where('achat_id', $achat->id)->first();

    if($stock){

        $stock->update([
            'produits_id'=>$request->produits_id,
            'categorie_id'=>$request->categorie_id,
            'mouvement_stock'=>$request->quantite,
            'users_id'=>$request->users_id,
        ]);

    }

    return redirect()
        ->route('achats.index')
        ->with('success','Achat modifié avec succès.');
}

    /**
     * Supprimer un achat
     */
    public function destroy(Achat $achat)
    {
        $produit = Produit::find($achat->produits_id);

        if ($produit) {
            $produit->quantite_produit -= $achat->quantite;
            $produit->stock_actuel -= $achat->quantite;

            if ($produit->quantite_produit < 0) {
                $produit->quantite_produit = 0;
            }

            if ($produit->stock_actuel < 0) {
                $produit->stock_actuel = 0;
            }

            $produit->save();
        }

        Stock::where('achat_id', $achat->id)->delete();

        $achat->delete();

        return redirect()
            ->route('achats.index')
            ->with('success', 'Achat supprimé avec succès.');
    }
}