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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->integer('mouvement_stock'); //+20 pour achat -2 pour vente par exemple
            $table->foreignId('vente_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('achat_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('produits_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('stocks');
    }
};
