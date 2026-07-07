<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users; 
use App\Models\Departements;
use App\Models\Objectif;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. On lance tous les seeders (les données sont créées ici)
        $this->call([
            DepartementsSeeder::class,
            UsersSeeder::class,
            AchatSeeder::class,
            CategorieSeeder::class,
            CongeSeeder::class,
            ObjectifSeeder::class,
            PointageSeeder::class,
            ProduitSeeder::class,
            StockSeeder::class,
            TachesSeeder::class,
            VenteItemSeeder::class,
            VenteSeeder::class,
        ]);

        // 2. On récupère les collections pour faire les liaisons
        $users = Users::all();
        $departements = Departements::all();
        $objectifs = Objectif::all();

        // 3. Liaison Users <-> Departements (Sécurisée)
        if ($users->isNotEmpty() && $departements->isNotEmpty()) {
            $users->each(function ($user) use ($departements) {
                // On attache aléatoirement 1 ou 2 départements
                $user->departements()->attach(
                    $departements->random(rand(1, min(2, $departements->count())))->pluck('id')->toArray()
                );
            });
        }

        // 4. Liaison Departements <-> Objectifs (Sécurisée)
        if ($departements->isNotEmpty() && $objectifs->isNotEmpty()) {
            $departements->each(function ($dep) use ($objectifs) {
                // On attache aléatoirement 1 à 3 objectifs
                $dep->objectifs()->attach(
                    $objectifs->random(rand(1, min(3, $objectifs->count())))->pluck('id')->toArray()
                );
            });
        }

        // 5. Gestion des Rôles (Ta logique existante)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $employeRole = Role::firstOrCreate(['name' => 'Employe']);

        $adminUser = Users::where('email', 'admin@test.com')->first();
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}