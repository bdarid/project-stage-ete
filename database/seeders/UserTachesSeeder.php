<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Taches;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class UserTachesSeeder extends Seeder
{
    public function run()
    {
        // 1. On vide la table pour être sûr de repartir de zéro
        DB::table('user_taches')->truncate();

        $taches = Taches::all();
        $users = Users::all();

        if ($taches->isEmpty() || $users->isEmpty()) {
            echo "Erreur : Pas de tâches ou d'utilisateurs trouvés.\n";
            return;
        }

        foreach ($taches as $tache) {
            $user = $users->random();
            
            // On force l'insertion manuellement via la relation Eloquent corrigée
            $tache->users()->attach($user->id);
        }
        
        echo "Table user_taches remplie avec succès !\n";
    }
}