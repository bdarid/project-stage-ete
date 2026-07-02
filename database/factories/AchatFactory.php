<?php

namespace Database\Factories;

use App\Models\Achat;
use App\Models\Categorie;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achat>
 */
class AchatFactory extends Factory
{
    protected $model = Achat::class;

    public function definition(): array
    {
        $prixAchat = $this->faker->randomFloat(2, 10, 500);
        
        return [
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? Categorie::factory(),
            'prix_achat' => $prixAchat,
            'prix_vente' => $prixAchat + $this->faker->randomFloat(2, 5, 200), // Prix de vente > prix achat
            // 'benefice' est calculé automatiquement par MySQL
            'nom_fournisseur' => $this->faker->company(),
            'date_achat' => $this->faker->date(),
            'quantite' => $this->faker->numberBetween(1, 100),
            'users_id' => Users::inRandomOrder()->first()?->id ?? Users::factory(),
            'commentaire' => $this->faker->sentence(),
        ];
    }
}