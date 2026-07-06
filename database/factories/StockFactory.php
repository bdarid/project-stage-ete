<?php

namespace Database\Factories;

use App\Models\Achat;
use App\Models\Categorie;
use App\Models\Produit;
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
    $produit = Produit::inRandomOrder()->first() ?? Produit::factory()->create();

    $isVente = $this->faker->boolean();

    return [
        'produits_id' => $produit->id,

        'categorie_id' => $produit->categorie_id,

        'users_id' => Users::inRandomOrder()->first()?->id ?? Users::factory(),

        'vente_id' => $isVente
            ? Vente::inRandomOrder()->first()?->id
            : null,

        'achat_id' => !$isVente
            ? Achat::inRandomOrder()->first()?->id
            : null,

        'mouvement_stock' => $isVente
            ? $this->faker->numberBetween(-10, -1)
            : $this->faker->numberBetween(1, 50),
    ];
}
}