<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('evento_servicio', function (Blueprint $table) {

        // SOLO agregar si NO existe
        if (!Schema::hasColumn('evento_servicio', 'precio_personalizado')) {
            $table->decimal('precio_personalizado', 10, 2)
                ->nullable()
                ->after('descripcion_personalizada');
        }

    });
}

public function down(): void
{
    Schema::table('evento_servicio', function (Blueprint $table) {
        if (Schema::hasColumn('evento_servicio', 'precio_personalizado')) {
            $table->dropColumn('precio_personalizado');
        }
    });
}

};
