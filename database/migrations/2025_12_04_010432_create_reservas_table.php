<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_reserva');

            // Relaciones
            $table->foreignId('cliente_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('evento_id')->nullable()->constrained()->nullOnDelete();

            // Datos económicos
            $table->decimal('senia', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();

            // Estado
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada'])
                  ->default('pendiente');

            // Información extra
            $table->string('metodo_pago')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
