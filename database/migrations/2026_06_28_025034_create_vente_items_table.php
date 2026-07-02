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
        Schema::create('vente_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->foreignId('achat_id')->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('prix_unitaire', 10, 2);
            $table->integer('quantite');
            $table->decimal('total_ligne', 10, 2)->virtualAs('quantite * prix_unitaire');
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
        Schema::dropIfExists('vente_items');
    }
};
