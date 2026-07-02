<?php

namespace Database\Factories;

use App\Models\Pointage;
use App\Models\Users;
use App\Models\Conge;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointageFactory extends Factory
{
    protected $model = Pointage::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            // On simule une arrivée entre 8h et 10h, et un départ entre 16h et 18h
            'heure_arrive' => $this->faker->time('H:i:s'),
            'heure_depart' => $this->faker->time('H:i:s'),
            // 'duree' est ignoré car calculé automatiquement (virtualAs)
            
            'statut' => $this->faker->randomElement(['present', 'abscent', 'en conge', 'en retard']),
            'Justification_retard' => $this->faker->sentence(),
            'type_justif_absence' => $this->faker->randomElement(['accepte', 'refuse']),
            'reponse_absense' => $this->faker->sentence(),
            
            // Clés étrangères
            'users_id' => Users::inRandomOrder()->first()->id ?? Users::factory(),
            'manager_id' => Users::inRandomOrder()->first()->id ?? Users::factory(),
            'conge_id' => Conge::inRandomOrder()->first()->id ?? Conge::factory(),
        ];
    }
}