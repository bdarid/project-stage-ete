<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // 1. Validation stricte basée sur les champs présents dans create.blade.php
        $request->validate([
            'name_users' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'CIN' => 'required|string|unique:users,CIN',
            'date_naissance' => 'required|date',
            'role' => 'required|exists:roles,name'
        ]);
        // 2. On génère un mot de passe aléatoire de 10 caractères
        $password_clair = \Illuminate\Support\Str::random(10);

        // 2. Création sécurisée de l'utilisateur
        $user = Users::create([
            'name_users' => $request->name_users,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($password_clair),
            'CIN' => $request->CIN,
            'date_naissance' => $request->date_naissance,
        ]);

        $user->assignRole($request->role);
        // 5. Envoi de l'email de bienvenue
        \Illuminate\Support\Facades\Mail::to($user->email)->send(
            new \App\Mail\WelcomeUserMail($user, $password_clair, $request->role)
        );
        // 4. Redirection vers le tableau
        return redirect()->route('users.index')->with('success', 'Employé créé avec succès et email envoyé !');
    }

    // Affiche le formulaire de modification avec les rôles
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        $roles = Role::all(); // Récupère tous les rôles pour la liste déroulante
        return view('users.edit', compact('user', 'roles'));
    }

    // Sauvegarde les modifications (y compris le rôle)
    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);

        // Validation (on exclut l'ID de l'utilisateur actuel pour que l'email et le CIN "unique" ne bloquent pas)
        $request->validate([
            'name_users' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'CIN' => 'required|string|unique:users,CIN,'.$id,
            'date_naissance' => 'required|date',
            'role' => 'required|exists:roles,name' // Validation du rôle
        ]);

        $user->update([
            'name_users' => $request->name_users,
            'email' => $request->email,
            'CIN' => $request->CIN,
            'date_naissance' => $request->date_naissance,
        ]);
        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'Employé et rôle mis à jour avec succès !');
    }

    // Supprime un employé
    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Employé supprimé avec succès !');
    }
}
