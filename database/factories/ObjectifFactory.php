<?php

namespace Database\Factories;

use App\Models\Objectif;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Objectif>
 */
class ObjectifFactory extends Factory
{
    protected $model = Objectif::class;

    public function definition(): array
    {
        $dateDebut = $this->faker->dateTimeBetween('-2 months', 'now');
        $dateFin = (clone $dateDebut)->modify('+' . $this->faker->numberBetween(10, 60) . ' days');

        return [
            'titre_objectif' => $this->faker->company . ' - Objectif ' . $this->faker->numberBetween(1, 100),
            'description_objectif' => $this->faker->text(),
            // Simulation d'une structure JSON pour vos fichiers liés
            'file_json' => json_encode([
                'files' => [$this->faker->word . '.pdf', $this->faker->word . '.docx'],
                'uploaded_at' => now()->toDateTimeString()
            ]),
            'date_debut_obj' => $dateDebut->format('Y-m-d'),
            'date_fin_obj' => $dateFin->format('Y-m-d'),
            // 'duree_obj' est calculé par la base de données
            'etat_avancement_objectif' => $this->faker->numberBetween(0, 100),
        ];
    }
}