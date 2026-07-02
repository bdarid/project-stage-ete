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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->integer('duree')->virtualAs('DATEDIFF(date_fin, date_debut)')->nullable(); //calcul en jour on the fly
            $table->integer('solde')->default(30);//en jours
            $table->foreignId('users_id')->constrained()->cascadeOnDelete();
            $table->enum('statut',['en attente', 'en cours', 'hors conge']);
            $table->enum('reponse',['accepte','refuse']);
            $table->enum('type_conge',['annuel','maladie','jours_ferie','conge_de_maternite']);
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
        Schema::dropIfExists('conges');
    }
};
