<?php

namespace Database\Seeders;

use App\Models\Departements;
use Illuminate\Database\Seeder;

class DepartementsSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les départements
        Departements::factory(10)->create();
    }
}
