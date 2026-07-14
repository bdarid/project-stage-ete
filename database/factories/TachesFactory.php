<?php

namespace Database\Factories;

use App\Models\Taches;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Taches>
 */
class TachesFactory extends Factory
{
    protected $model = Taches::class;

    public function definition(): array
    {
        $dateDebut = $this->faker->dateTimeBetween('-1 month', 'now');
        $dateFin = (clone $dateDebut)->modify('+' . $this->faker->numberBetween(1, 10) . ' days');

        return [
            'titre_taches' => $this->faker->sentence(3),
            'description_taches' => $this->faker->paragraph(),
            'date_debut' => $dateDebut->format('Y-m-d'),
            'date_fin' => $dateFin->format('Y-m-d'),
            'statut' => $this->faker->randomElement(['en cours', 'fini', 'en retard']),
            'priorite' => $this->faker->randomElement(['haute', 'basse', 'urgent']),
            'justif_retard_tache' => $this->faker->sentence(),
            'type_justif' => $this->faker->randomElement(['accepte', 'refuse']),
        ];
    }
}