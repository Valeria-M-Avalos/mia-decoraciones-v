<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->nullable()
                  ->constrained('servicios')->nullOnDelete();

            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->time('hora');

            $table->string('lugar')->nullable();
            $table->string('tipo_evento')->nullable();
            $table->integer('invitados')->nullable();
            $table->decimal('costo', 10, 2)->nullable();

           $table->foreignId('cliente_id')
                 ->constrained('clientes')
                 ->cascadeOnDelete();


            $table->string('estado')->default('Pendiente'); // Pendiente / Confirmado / Cancelado

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
