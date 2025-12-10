<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->string('tipo_evento');
            $table->date('fecha_evento')->nullable();
            $table->text('mensaje');
            $table->enum('estado', ['pendiente', 'contactado', 'convertido', 'descartado'])->default('pendiente');
            $table->text('notas_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
