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
        // Récupérer le pointage d'aujourd'hui pour cet utilisateur
        $pointageAujourdhui = Pointage::where('user_id', $user->id)
            ->whereDate('date_pointage', Carbon::today())
            ->first();

        return view('pointage.index', compact('pointageAujourdhui'));
    }

    // Pointer l'entrée
    public function pointerEntree()
    {
        $user = Auth::user();

        // Vérifier si l'employé n'a pas déjà pointé aujourd'hui
        $existe = Pointage::where('user_id', $user->id)
            ->whereDate('date_pointage', Carbon::today())
            ->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'Vous avez déjà pointé votre entrée aujourd\'hui.');
        }

        // Création de la ligne de pointage
        Pointage::create([
            'user_id' => $user->id,
            'date_pointage' => Carbon::today()->toDateString(),
            'heure_entree' => Carbon::now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Entrée enregistrée avec succès à ' . Carbon::now()->format('H:i'));
    }

    // Pointer la sortie
    public function pointerSortie()
    {
        $user = Auth::user();

        $pointage = Pointage::where('user_id', $user->id)
            ->whereDate('date_pointage', Carbon::today())
            ->first();

        if (!$pointage) {
            return redirect()->back()->with('error', 'Vous devez d\'abord pointer votre entrée.');
        }

        if ($pointage->heure_sortie) {
            return redirect()->back()->with('error', 'Vous avez déjà pointé votre sortie aujourd\'hui.');
        }

        // Mise à jour de l'heure de sortie
        $pointage->update([
            'heure_sortie' => Carbon::now()->toTimeString()
        ]);

        return redirect()->back()->with('success', 'Sortie enregistrée avec succès à ' . Carbon::now()->format('H:i'));
    }
}
