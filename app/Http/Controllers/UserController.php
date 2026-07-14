<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Notifications\WelcomeNotification;

class UserController extends Controller
{
   public function index(Request $request)
{
    // 1. On prépare la requête de base
    $query = Users::query();

    // 2. Filtre de Recherche (par nom ou email)
    // 2. Filtre de Recherche (par nom ou email)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name_users', 'like', "%{$search}%") 
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('CIN', 'like', "%{$search}%"); 
        });
    }

    // 3. Filtre par Statut (active ou desactive)
    if ($request->filled('status')) {
        $query->where('statut', $request->status);
    }

    // 4. Filtre par Rôle
    if ($request->filled('role')) {
        $query->whereHas('roles', function($q) use ($request) {
            $q->where('name', $request->role);
        });
    }

    $users = $query->latest()->paginate(10)->withQueryString();
    
    // On récupère tous les rôles pour le menu déroulant
    $roles = Role::all();

    return view('users.index', compact('users', 'roles'));
}

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // 1. Validation stricte (ajout de 'statut')
        $request->validate([
            'name_users' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'CIN' => 'required|string|unique:users,CIN',
            'date_naissance' => 'required|date',
            'role' => 'required|exists:roles,name',
            'statut' => 'nullable|in:active,desactive' // nullable car géré par le default() de la migration
        ]);

        // 2. On génère un mot de passe aléatoire de 10 caractères
        $password_clair = \Illuminate\Support\Str::random(10);

        // 3. Création sécurisée de l'utilisateur (ajout du 'statut')
        $user = Users::create([
            'name_users' => $request->name_users,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($password_clair),
            'CIN' => $request->CIN,
            'date_naissance' => $request->date_naissance,
            'statut' => $request->statut ?? 'active', // Si non fourni dans le formulaire, par défaut 'active'
        ]);

        $user->assignRole($request->role);

        // 4. Envoi de l'email de bienvenue VIA NOTIFICATION UNIQUEMENT
        $user->notify(new WelcomeNotification($password_clair, $request->role));

        // 5. Redirection vers le tableau
        return redirect()->route('users.index')->with('success', 'Employé créé avec succès et email envoyé !');
    }

    // Affiche le formulaire de modification avec les rôles
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        $roles = Role::all(); // Récupère tous les rôles pour la liste déroulante
        
        return view('users.edit', compact('user', 'roles'));
    }

    // Sauvegarde les modifications (y compris le rôle et le statut)
    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);

        // Validation (ajout de 'statut')
        $request->validate([
            'name_users' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'CIN' => 'required|string|unique:users,CIN,'.$id,
            'date_naissance' => 'required|date',
            'role' => 'required|exists:roles,name',
            'statut' => 'required|in:active,desactive'
        ]);

        $user->update([
            'name_users' => $request->name_users,
            'email' => $request->email,
            'CIN' => $request->CIN,
            'date_naissance' => $request->date_naissance,
            'statut' => $request->statut, // Mise à jour du statut
        ]);
        
        $user->syncRoles($request->role);

        return redirect()
        ->route('users.index')
        ->with('success', 'Employé mis à jour avec succès.');

    }

    // Supprime un employé définitivement
    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Employé supprimé avec succès !');
    }

    // --- MÉTHODE BONUS : Activer / Désactiver rapidement un utilisateur ---
    public function toggleStatus($id)
    {
        $user = Users::findOrFail($id);
        
        // Inverse le statut actuel
        $user->statut = $user->statut === 'active' ? 'desactive' : 'active';
        $user->save();

        $message = $user->statut === 'active' ? 'Employé réactivé !' : 'Employé désactivé !';
        
        return redirect()->route('users.index')->with('success', $message);
    }
}