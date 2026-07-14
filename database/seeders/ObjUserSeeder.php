<?php

namespace Database\Seeders;

use App\Models\Objectif;
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obj_users')->truncate();

        $users = Users::all();
        $objectifs = Objectif::all();

        if ($users->isEmpty() || $objectifs->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            // Assign between 1 and 3 random objectifs
            $randomObjectifs = $objectifs->random(
                min(rand(1, 3), $objectifs->count())
            );

            foreach ($randomObjectifs as $objectif) {
                DB::table('obj_users')->insert([
                    'users_id'      => $user->id,
                    'objectif_id'  => $objectif->id,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }
}