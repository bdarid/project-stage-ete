<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('titre_taches');
            $table->text('description_taches');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->integer('duree')->virtualAs('DATEDIFF(date_fin, date_debut)')->nullable(); //calcul en jour on the fly
            $table->enum('statut',['en cours','fini','en retard'])->default('en cours');
            $table->enum('priorite',['haute','basse','urgent'])->default('basse');
            $table->string('justif_retard_tache');
            $table->enum('type_justif',['accepte','refuse']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taches');
    }
};
