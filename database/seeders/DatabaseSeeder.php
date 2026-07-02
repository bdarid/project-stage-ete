<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users; // <--- MODIFIÉ : On importe Users
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $employeRole = Role::firstOrCreate(['name' => 'Employe']);

        // L'admin est déjà créé dans UsersSeeder, on le récupère juste
        $adminUser = Users::where('email', 'admin@test.com')->first();
        $adminUser->assignRole($adminRole);
    }
}
