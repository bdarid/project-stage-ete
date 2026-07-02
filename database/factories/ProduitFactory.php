<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition(): array
    {
        $prixAchat = $this->faker->randomFloat(2, 10, 100);
        $prixVente = $prixAchat + $this->faker->randomFloat(2, 5, 50);

        return [
            'nom_produit' => $this->faker->words(2, true),
            'description_produit' => $this->faker->sentence(),
            'quantite_produit' => $this->faker->numberBetween(0, 100),
            'stock_actuel' => $this->faker->numberBetween(0, 100),
            'date_expiration' => $this->faker->dateTimeBetween('now', '+2 years'),
            'prix_achat_moy' => $prixAchat,
            'prix_vente_moy' => $prixVente,
            // 'benefice' est calculé automatiquement (virtualAs)
            'alerte_stock' => 5,
            'reference' => $this->faker->unique()->bothify('REF-####'),
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? Categorie::factory(),
            'users_id' => Users::inRandomOrder()->first()?->id ?? Users::factory(),
        ];
    }
}