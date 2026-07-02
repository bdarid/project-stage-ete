<?php

namespace Database\Factories;

use App\Models\Conge;
use App\Models\Users; 
use Illuminate\Database\Eloquent\Factories\Factory;

class CongeFactory extends Factory
{
    protected $model = Conge::class;

    public function definition(): array
    {
        // Génère une date de début logique (entre le mois dernier et le mois prochain)
        $dateDebut = $this->faker->dateTimeBetween('-1 month', '+1 month');
        // Génère une date de fin entre 1 et 15 jours APRÈS la date de début
        $dateFin = (clone $dateDebut)->modify('+' . $this->faker->numberBetween(1, 15) . ' days');

        return [
            'date_debut' => $dateDebut->format('Y-m-d'),
            'date_fin' => $dateFin->format('Y-m-d'),
            // 'duree' est ignoré car MySQL le calcule "on the fly"
            'solde' => $this->faker->numberBetween(5, 30),
            
            // Va chercher un utilisateur au hasard. S'il n'y en a pas, en crée un.
            'users_id' => Users::inRandomOrder()->first()->id ?? Users::factory(),
            
            'statut' => $this->faker->randomElement(['en attente', 'en cours', 'hors conge']),
            'reponse' => $this->faker->randomElement(['accepte', 'refuse']),
            'type_conge' => $this->faker->randomElement(['annuel', 'maladie', 'jours_ferie', 'conge_de_maternite']),
        ];
    }
}