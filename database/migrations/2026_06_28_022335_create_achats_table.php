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
        Schema::create('achats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->float('prix_vente');
            $table->float('prix_achat');
            $table->float('benefice')->virtualAs('prix_vente - prix_achat');
            $table->string('nom_fournisseur');
            $table->foreignId('produits_id')->constrained()->cascadeOnDelete();
            $table->date('date_achat');
            $table->integer('quantite');
            $table->foreignId('users_id')->constrained()->cascadeOnDelete();
            $table->text('commentaire');
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
        Schema::dropIfExists('achats');
    }
};
