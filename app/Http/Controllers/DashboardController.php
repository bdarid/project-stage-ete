<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Vente;
use App\Models\Users;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si l'utilisateur est un Administrateur
        if ($user->hasRole('Admin')) {
            $totalEmployes = Users::count();
            $totalProduits = Produit::count();
            $valeurStock = Produit::sum(\DB::raw('prix_vente_moy * quantite_produit'));
            $totalbenifice = Produit::sum('benefice'); // En supposant que vous avez cette colonne

            return view('dashboard.admin', compact('totalEmployes', 'totalProduits', 'valeurStock', 'totalbenifice'));
        }

        // Si c'est un Employé classique
        $mesTaches = $user->taches()->where('statut', '!=', 'Terminé')->get(); // Via la table pivot user_taches

        return view('dashboard.employe', compact('mesTaches'));
    }
}
