<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Récupère tous les utilisateurs triés du plus récent au plus ancien
        $users = Users::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // 1. Validation stricte basée sur les champs présents dans create.blade.php
        $request->validate([
            'name_users' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'CIN' => 'required|string|unique:users,CIN',
            'date_naissance' => 'required|date',
        ]);

        // 2. Création sécurisée de l'utilisateur
        $user = Users::create([
            'name_users' => $request->name_users,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Utilisation du helper global pour éviter le bug d'import de Hash
            'CIN' => $request->CIN,
            'date_naissance' => $request->date_naissance,
             // Valeur par défaut pour correspondre à ton index.blade.php
        ]);

        // 3. Attribution du rôle automatique via Spatie si nécessaire
        if ($user && method_exists($user, 'assignRole')) {
            try {
                $user->assignRole('Employe');
            } catch (\Exception $e) {
                // Évite de bloquer si le rôle n'est pas encore créé dans les seeders
            }
        }

        // 4. Redirection vers le tableau
        return redirect()->route('users.index')->with('success', 'Nouvel employé ajouté avec succès !');
    }
    // NOUVEAU : Affiche le formulaire de modification
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // NOUVEAU : Sauvegarde les modifications
    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);

        // Validation (on exclut l'ID de l'utilisateur actuel pour que l'email et le CIN "unique" ne bloquent pas)
        $request->validate([
            'name_users' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'CIN' => 'required|string|unique:users,CIN,'.$id,
            'date_naissance' => 'required|date',
            'password' => 'nullable|string|min:8', // nullable = optionnel
        ]);

        // Mise à jour des informations
        $user->name_users = $request->name_users;
        $user->email = $request->email;
        $user->CIN = $request->CIN;
        $user->date_naissance = $request->date_naissance;

        // On modifie le mot de passe QUE s'il a été rempli dans le formulaire
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Employé mis à jour avec succès !');
    }

    // NOUVEAU : Supprime un employé
    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Employé supprimé avec succès !');
    }
}
