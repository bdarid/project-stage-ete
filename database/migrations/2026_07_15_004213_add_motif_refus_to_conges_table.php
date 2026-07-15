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
    Schema::table('conges', function (Blueprint $table) {
        $table->text('motif_refus')->nullable()->after('reponse');
    });
}

public function down()
{
    Schema::table('conges', function (Blueprint $table) {
        $table->dropColumn('motif_refus');
    });
}
};
