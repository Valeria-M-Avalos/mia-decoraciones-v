<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('evento_servicio', function (Blueprint $table) {
        $table->text('descripcion_personalizada')->nullable();
    });
}

public function down()
{
    Schema::table('evento_servicio', function (Blueprint $table) {
        $table->dropColumn('descripcion_personalizada');
    });
}

};
