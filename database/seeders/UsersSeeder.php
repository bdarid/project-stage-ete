<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
{
    try {
        \App\Models\Users::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name_users'     => 'Yassine Admin',
                'password'       => bcrypt('password'),
                'CIN'            => 'AB000000',
                'date_embauche'  => now(),
                'date_naissance' => '1995-01-01',
                'jours_de_repos' => ['Saturday', 'Sunday'],
            ]
        );
        $this->command->info('Admin créé avec succès.');
    } catch (\Exception $e) {
        $this->command->error('Erreur lors de la création de l\'admin : ' . $e->getMessage());
    }
Users::factory(25)->create();
}
}
