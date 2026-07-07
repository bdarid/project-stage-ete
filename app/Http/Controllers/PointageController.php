<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pointage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PointageController extends Controller
{
    // Afficher la page de pointage
    public function index()
    {
        $user = Auth::user();
        
        $pointageAujourdhui = Pointage::where('users_id', $user->id)
            ->whereDate('date', Carbon::today())
            ->first();

        return view('pointage.index', compact('pointageAujourdhui'));
    }
    public function adminIndex()
{
    // On récupère tous les pointages avec l'utilisateur, son manager, et ses congés en cours
   $pointages = Pointage::with([
    'users',
    'users.manager',
    'users.conges'
])->orderBy('date', 'desc')
  ->paginate(15);

    return view('pointage.adminindex', compact('pointages'));
}

    // Pointer l'entrée
    public function pointerEntree()
    {
        $user = Auth::user();

        // Vérifier si l'employé n'a pas déjà pointé aujourd'hui
        $existe = Pointage::where('users_id', $user->id)
            ->whereDate('date', Carbon::today())
            ->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'Vous avez déjà pointé votre entrée aujourd\'hui.');
        }

        // Création de la ligne de pointage avec les noms exacts de la BDD
        Pointage::create([
            'users_id' => $user->id,
            'date' => Carbon::today()->toDateString(),
            'heure_arrive' => Carbon::now()->toTimeString(),
            'statut' => 'present', // Ajouté pour éviter l'erreur de champ vide
            'Justification_retard' => 'Aucune', // Valeur par défaut requise par ta BDD
            'reponse_absense' => 'N/A', // Valeur par défaut requise
        ]);

        return redirect()->back()->with('success', 'Entrée enregistrée avec succès à ' . Carbon::now()->format('H:i'));
    }

    // Pointer la sortie
    public function pointerSortie()
    {
        $user = Auth::user();

        $pointage = Pointage::where('users_id', $user->id)
            ->whereDate('date', Carbon::today())
            ->first();

        if (!$pointage) {
            return redirect()->back()->with('error', 'Vous devez d\'abord pointer votre entrée.');
        }

        if ($pointage->heure_depart) {
            return redirect()->back()->with('error', 'Vous avez déjà pointé votre sortie aujourd\'hui.');
        }

        // Mise à jour de l'heure de sortie
        $pointage->update([
            'heure_depart' => Carbon::now()->toTimeString()
        ]);

        return redirect()->back()->with('success', 'Sortie enregistrée avec succès à ' . Carbon::now()->format('H:i'));
    }
}