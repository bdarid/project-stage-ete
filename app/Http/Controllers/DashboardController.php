<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Produit;
use App\Models\Vente;
use App\Models\Users; // On garde bien ton modèle custom Users

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si l'utilisateur est un Administrateur (Statistiques conservées à 100%)
        if ($user->hasRole('Admin')) {
            $totalEmployes = Users::count();
            $totalProduits = Produit::count();
            $valeurStock = Produit::sum(\DB::raw('prix_vente_moy * quantite_produit'));
            $totalbenifice = Produit::sum('benefice');

            return view('dashboard.admin', compact('totalEmployes', 'totalProduits', 'valeurStock', 'totalbenifice'));
        }

        // Si c'est un Employé classique (Besoins opérationnels ajoutés)
        // Utilisation de requêtes fluides sur vos vraies colonnes (taches_id, users_id)
        $mesTaches = DB::table('taches')
            ->join('user_taches', 'taches.id', '=', 'user_taches.taches_id')
            ->where('user_taches.users_id', $user->id)
            ->select('taches.*')
            ->orderBy('taches.created_at', 'desc')
            ->get();

        // Calcul dynamique des compteurs requis pour le design de la vue employé
        $tachesEnCours = $mesTaches->where('statut', 'en cours')->count();
        $tachesTerminees = $mesTaches->where('statut', 'fini')->count();
        $tachesEnRetard = $mesTaches->where('statut', 'en retard')->count();

        // Redirection vers ta vue personnalisée avec toutes les variables requises
        return view('dashboard.employe', compact('mesTaches', 'tachesEnCours', 'tachesTerminees', 'tachesEnRetard'));
    }
}
