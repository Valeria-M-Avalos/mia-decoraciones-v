<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('evento_servicio', function (Blueprint $table) {
    $table->id();

    // Relación al evento
    $table->unsignedBigInteger('evento_id');
    $table->foreign('evento_id')
          ->references('id')->on('eventos')
          ->onDelete('cascade');

    // Relación al servicio
    $table->unsignedBigInteger('servicio_id');
    $table->foreign('servicio_id')
          ->references('id')->on('servicios')
          ->onDelete('cascade');

    // Datos extra del servicio dentro del evento
    $table->integer('cantidad')->default(1);
    $table->decimal('precio', 10, 2)->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento_servicio');
      
    }
};
