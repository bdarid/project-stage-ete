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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom_produit');
            $table->text('description_produit')->nullable();
            $table->integer('quantite_produit')->default(0);
            $table->date('date_expiration');
            $table->integer('stock_actuel')->default(0);
            $table->decimal('prix_vente_moy', 10, 2);
            $table->decimal('prix_achat_moy', 10, 2);
            $table->float('benefice')->virtualAs('prix_vente_moy - prix_achat_moy');
            $table->integer('alerte_stock')->default(5);//alerte quand stock inferieure a 5
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->string('reference')->unique();
            $table->foreignId('users_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('produits');
    }
};
