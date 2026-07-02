<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition(): array
    {
        return [
            'nom_categorie' => $this->faker->unique()->word(),
            'description_categorie' => $this->faker->sentence(),
            // 30% de chance d'être une catégorie racine (null), sinon pointe vers un parent
            'parent_id' => $this->faker->optional(0.3)->randomElement(
                Categorie::pluck('id')->toArray()
            ),
        ];
    }
}