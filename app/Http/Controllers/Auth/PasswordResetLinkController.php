<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Affiche la vue de demande de réinitialisation.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Gère la demande, génère le mot de passe et envoie l'e-mail.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. On valide que l'adresse e-mail a bien été saisie
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // 2. On cherche si l'employé existe dans la base de données
        $user = Users::where('email', $request->email)->first();

        // Si l'utilisateur n'existe pas, on retourne une erreur propre
        if (!$user) {
            return back()->withErrors([
                'email' => 'Aucun compte ERP n\'est associé à cette adresse e-mail.',
            ]);
        }

        // 3. L'ASTUCE : On génère un mot de passe aléatoire de 8 caractères
        $nouveau_mot_de_passe = Str::random(8);

        // 4. On met à jour son mot de passe directement dans la table `users`
        $user->update([
            'password' => Hash::make($nouveau_mot_de_passe),
        ]);

        // 5. On déclenche notre notification modifiée en lui passant le mot de passe en clair
        $user->notify(new ResetPasswordNotification($nouveau_mot_de_passe));

        // 6. On redirige l'utilisateur avec un message de succès vert
        return back()->with('status', 'Un nouveau mot de passe automatique vous a été envoyé.');
    }
}
