<?php

namespace Database\Factories;

use App\Models\Departements; 
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartementsFactory extends Factory
{
    protected $model = Departements::class;

    public function definition(): array
    {
        return [
            'nom_departement' => $this->faker->randomElement([
                'Ressources Humaines',
                'Informatique (DSI)',
                'Comptabilité et Finances',
                'Production',
                'Logistique et Stocks',
                'Ventes et Commercial',
                'Marketing',
                'Direction Générale'
            ]),

        ];
    }
}