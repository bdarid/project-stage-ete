<?php

namespace Database\Factories;

use App\Models\Achat;
use App\Models\Categorie;
use App\Models\Stock;
use App\Models\Users;
use App\Models\Vente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition(): array
    {
        // Choisit aléatoirement si c'est une vente ou un achat
        $isVente = $this->faker->boolean();

        return [
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? Categorie::factory(),
            'users_id' => Users::inRandomOrder()->first()?->id ?? Users::factory(),
            
            // Logique de mouvement
            'vente_id' => $isVente ? Vente::inRandomOrder()->first()?->id : null,
            'achat_id' => !$isVente ? Achat::inRandomOrder()->first()?->id : null,
            'mouvement_stock' => $isVente ? $this->faker->numberBetween(-10, -1) : $this->faker->numberBetween(1, 50),
        ];
    }
}