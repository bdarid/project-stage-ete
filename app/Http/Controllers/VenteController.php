<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use App\Models\Vente_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{
    public function index()
    {
        // On affiche les ventes (assure-toi que la relation s'appelle bien 'user' dans ton modèle Vente)
        $ventes = Vente::with('user')->orderBy('created_at', 'desc')->get();
        return view('ventes.index', compact('ventes'));
    }

    public function store(Request $request)
    {
        // 1. Validation alignée sur la migration de ton ami
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'info_clients' => 'required|string|max:255',
            'date_vente' => 'required|date',
            'mode_payment' => 'required|in:especes,virement_banquaire,cheque',
            'numero_vente' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id', // Obligatoire selon la migration
        ]);

        $produit = Produit::find($request->produit_id);

        if ($produit->quantite_actuelle < $request->quantite) {
            return redirect()->back()->with('error', 'Stock insuffisant pour cette vente.');
        }

        // On utilise une transaction pour être sûr que tout s'enregistre (ou rien)
        DB::transaction(function () use ($request, $produit) {

            // 2. Créer la Vente avec les colonnes exactes de la migration
            $vente = Vente::create([
                'users_id' => Auth::id(), // Ton ami a mis un 's' à users_id
                'info_clients' => $request->info_clients,
                'date_vente' => $request->date_vente,
                'mode_payment' => $request->mode_payment,
                'numero_vente' => $request->numero_vente,
                'categorie_id' => $request->categorie_id,
            ]);

            // 3. Lier le produit à la vente
            // (Assure-toi que la table pour Vente_item a bien été migrée par ton ami aussi)
            Vente_item::create([
                'vente_id' => $vente->id,
                'produit_id' => $produit->id,
                'quantite_vendue' => $request->quantite,
                'prix_unitaire_applique' => $produit->prix_unitaire
            ]);

            // 4. Déduire le stock
            $produit->decrement('quantite_actuelle', $request->quantite);
        });

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée et stock mis à jour.');
    }
}
