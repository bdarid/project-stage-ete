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
        Schema::create('pointages', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('heure_arrive');
            $table->time('heure_depart');
            $table->integer('duree')->virtualAs('DATEDIFF(heure_arrive, heure_depart)');
            $table->enum('statut',['present', 'abscent', 'en conge','en retard']);
            $table->text('Justification_retard');
            $table->enum('type_justif_absence',['accepte','refuse']);
            $table->string('reponse_absense');
            $table->foreignId('users_id')->constrained()->cascadeOnDelete();
            $table->foreignId('manager_id')->constrained()->cascadeOnDelete();
            $table->foreignId('conge_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('pointages');
    }
};
