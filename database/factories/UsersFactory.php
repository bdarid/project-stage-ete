<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_users' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            
            'password' => Hash::make('password'), 
            
            'CIN' => strtoupper(fake()->unique()->bothify('??######')), 
            
            'date_embauche' => fake()->dateTimeBetween('-5 years', 'now'),
            
            'contract_document' => null, 
            
            // Date de naissance entre 18 et 6o ans
            'date_naissance' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            
            'jours_de_repos' => ['Saturday', 'Sunday'], 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
