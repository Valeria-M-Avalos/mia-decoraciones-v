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
        Schema::create('galeria_imagenes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('tipo_evento'); // cumpleaños, boda, xv_años, bautizo
            $table->string('imagen'); // Nombre del archivo
            $table->boolean('destacada')->default(false); // Para mostrar en home
            $table->integer('orden')->default(0); // Para ordenar las imágenes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeria_imagenes');
    }
};