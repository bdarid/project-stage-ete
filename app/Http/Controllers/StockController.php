<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Achat;
use App\Models\Vente;
use App\Models\Users;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Afficher la liste des mouvements de stock
     */
    public function index()
    {
        $stocks = Stock::with([
            'produit',
            'categorie',
            'achat',
            'vente',
            'users'
        ])->latest()->paginate(10);

        return view('stocks.index', compact('stocks'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('stocks.create', [
            'produits' => Produit::all(),
            'categories' => Categorie::all(),
            'achats' => Achat::all(),
            'ventes' => Vente::all(),
            'users' => Users::all(),
        ]);
    }

    /**
     * Enregistrer un mouvement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produits_id' => 'required|exists:produits,id',
            'categorie_id' => 'required|exists:categories,id',
            'mouvement_stock' => 'required|integer',
            'vente_id' => 'nullable|exists:ventes,id',
            'achat_id' => 'nullable|exists:achats,id',
            'users_id' => 'required|exists:users,id',
        ]);

        Stock::create($validated);

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Mouvement de stock créé avec succès.');
    }

    /**
     * Afficher un mouvement
     */
    public function show(Stock $stock)
    {
        $stock->load([
            'produit',
            'categorie',
            'achat',
            'vente',
            'users'
        ]);

        return view('stocks.show', compact('stock'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(Stock $stock)
    {
        return view('stocks.edit', [
            'stock' => $stock,
            'produits' => Produit::all(),
            'categories' => Categorie::all(),
            'achats' => Achat::all(),
            'ventes' => Vente::all(),
            'users' => Users::all(),
        ]);
    }

    /**
     * Mettre à jour un mouvement
     */
    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'produits_id' => 'required|exists:produits,id',
            'categorie_id' => 'required|exists:categories,id',
            'mouvement_stock' => 'required|integer',
            'vente_id' => 'nullable|exists:ventes,id',
            'achat_id' => 'nullable|exists:achats,id',
            'users_id' => 'required|exists:users,id',
        ]);

        $stock->update($validated);

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Mouvement de stock mis à jour avec succès.');
    }

    /**
     * Supprimer un mouvement
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Mouvement supprimé avec succès.');
    }
}