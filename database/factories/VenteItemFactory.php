<?php

namespace Database\Factories;

use App\Models\Achat;
use App\Models\Categorie;
use App\Models\Vente_item;
use App\Models\Vente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vente_item>
 */
class VenteItemFactory extends Factory
{
    protected $model = Vente_item::class;

    public function definition(): array
    {
        return [
            'vente_id' => Vente::inRandomOrder()->first()?->id ?? Vente::factory(),
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? Categorie::factory(),
            'achat_id' => Achat::inRandomOrder()->first()?->id ?? Achat::factory(),
            'prix_unitaire' => $this->faker->randomFloat(2, 10, 500),
            'quantite' => $this->faker->numberBetween(1, 20),
            // 'total_ligne' est géré automatiquement par SQL
        ];
    }
}