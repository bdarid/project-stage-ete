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
        Schema::create('objectifs', function (Blueprint $table) {
            $table->id();
            $table->string('titre_objectif');
            $table->text('description_objectif');
            $table->json('file_json');
            $table->date('date_debut_obj')->nullable();
            $table->date('date_fin_obj')->nullable();
            $table->integer('duree_obj')->virtualAs('DATEDIFF(date_fin_obj, date_debut_obj)')->nullable(); //calcul en jour on the fly
            $table->unsignedTinyInteger('etat_avancement_objectif')->default(0);
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
        Schema::dropIfExists('objectifs');
    }
};
