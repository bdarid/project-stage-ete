<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Users;
use App\Models\Vente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vente>
 */
class VenteFactory extends Factory
{
    protected $model = Vente::class;

    public function definition(): array
    {
        return [
            'info_clients' => $this->faker->name() . ' - ' . $this->faker->company(),
            'date_vente' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'mode_payment' => $this->faker->randomElement(['especes', 'virement_banquaire', 'cheque']),
            'numero_vente' => $this->faker->unique()->numberBetween(1000, 9999),
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? Categorie::factory(),
            'users_id' => Users::inRandomOrder()->first()?->id ?? Users::factory(),
        ];
    }
}