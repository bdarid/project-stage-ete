<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | ADMIN DASHBOARD
        |--------------------------------------------------------------------------
        */

        if ($user->hasRole('Admin')) {

            $totalEmployes = Users::count();

            $totalProduits = Produit::count();

            $valeurStock = Produit::sum(
                DB::raw('prix_vente_moy * quantite_produit')
            );

            $totalbenifice = Produit::sum('benefice');

            return view('dashboard.admin', compact(
                'totalEmployes',
                'totalProduits',
                'valeurStock',
                'totalbenifice'
            ));
        }

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE DASHBOARD
        |--------------------------------------------------------------------------
        */

        // Minutes travaillées durant le mois
        $heuresMois = DB::table('pointages')
            ->where('users_id', $user->id)
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('duree');

        // Tâches de l'utilisateur
        $taches = DB::table('taches')
            ->join('user_taches', 'taches.id', '=', 'user_taches.taches_id')
            ->where('user_taches.users_id', $user->id)
            ->select('taches.*')
            ->orderByDesc('taches.created_at')
            ->get();

        $tachesEnCours = $taches->where('statut', 'en cours')->count();

        $tachesEnRetard = $taches->where('statut', 'en retard')->count();

        $tachesTerminees = $taches->where('statut', 'fini')->count();

        // Solde congé
        $soldeConges = DB::table('conges')
            ->where('users_id', $user->id)
            ->latest()
            ->value('solde');

        if (is_null($soldeConges)) {
            $soldeConges = 30;
        }

        return view('dashboard.employe', compact(
            'heuresMois',
            'taches',
            'tachesEnCours',
            'tachesEnRetard',
            'tachesTerminees',
            'soldeConges'
        ));
    }
}