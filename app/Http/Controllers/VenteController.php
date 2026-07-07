<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Vente_item;
use App\Models\Categorie;
use App\Models\Achat;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{
    public function index()
    {
        // On charge les ventes avec leurs items pour pouvoir calculer le total
        $ventes = Vente::with(['categorie', 'venteitems'])->latest()->paginate(10);
        return view('ventes.index', compact('ventes'));
    }

    public function create()
    {
        $categories = Categorie::all();
        // On récupère les achats avec le nom du produit associé pour le menu déroulant
        $achats = Achat::with('produit')->where('quantite', '>', 0)->get(); 
        
        return view('ventes.create', compact('categories', 'achats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_vente' => 'required|unique:ventes',
            'date_vente' => 'required|date',
            'info_clients' => 'nullable|string|max:255',
            'mode_payment' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'items' => 'required|array|min:1',
            'items.*.achat_id' => 'required|exists:achats,id',
            'items.*.quantite' => 'required|integer|min:1',
            'items.*.prix_unitaire' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // 1. Création de la Vente
            $vente = Vente::create([
                'numero_vente' => $request->numero_vente,
                'date_vente' => $request->date_vente,
                'info_clients' => $request->info_clients,
                'mode_payment' => $request->mode_payment,
                'categorie_id' => $request->categorie_id,
                'users_id' => Auth::id(), // Assigne l'utilisateur connecté
            ]);

            // 2. Création des Vente_items et décrémentation des stocks
            foreach ($request->items as $item) {
                Vente_item::create([
                    'vente_id' => $vente->id,
                    'categorie_id' => $request->categorie_id, // Hérite de la catégorie de la vente
                    'achat_id' => $item['achat_id'],
                    'prix_unitaire' => $item['prix_unitaire'],
                    'quantite' => $item['quantite'],
                ]);

                // Mise à jour du stock actuel du produit concerné par l'achat
                $achat = Achat::findOrFail($item['achat_id']);
                if ($achat->produit) {
                    $achat->produit->decrement('stock_actuel', $item['quantite']);
                }
            }

            DB::commit();
            return redirect()->route('ventes.index')->with('success', 'La vente a été enregistrée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage())->withInput();
        }
    }

    public function show(Vente $vente)
    {
        $vente->load(['categorie', 'venteitems.achat.produit', 'users']);
        return view('ventes.show', compact('vente'));
    }

    public function edit(Vente $vente)
    {
        $categories = Categorie::all();
        $vente->load('venteitems');
        return view('ventes.edit', compact('vente', 'categories'));
    }

    public function update(Request $request, Vente $vente)
    {
        // Pour un ERP, la modification d'une vente validée est souvent restreinte.
        // Ici, on met à jour uniquement les infos générales pour simplifier.
        $request->validate([
            'date_vente' => 'required|date',
            'info_clients' => 'nullable|string|max:255',
            'mode_payment' => 'required|string',
        ]);

        $vente->update($request->only(['date_vente', 'info_clients', 'mode_payment']));

        return redirect()->route('ventes.index')->with('success', 'Les informations de la vente ont été mises à jour.');
    }

    public function destroy(Vente $vente)
    {
        // En cas de suppression, il faudrait théoriquement recréditer les stocks. 
        // Si ta DB utilise "cascadeOnDelete" sur les clés étrangères, les vente_items disparaîtront seuls.
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'La vente a été supprimée.');
    }
}