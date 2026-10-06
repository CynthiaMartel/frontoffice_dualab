<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Formularios de contacto por agente (centro, empresa, alumno, administración).
 * - `tipo` pasa de enum a string para admitir 'administracion' (la validación
 *   de valores permitidos vive en ContactoRequest).
 * - Campos comunes de la persona de contacto como columnas.
 * - Campos propios de cada agente en `datos` (JSON), validados por lista blanca.
 */
return new class extends Migration {
    public function up(): void
    {
        Schema::table('contactos', function (Blueprint $table) {
            $table->string('tipo', 20)->change();
            $table->string('apellidos')->nullable()->after('nombre');
            $table->string('cargo')->nullable()->after('telefono');
            $table->string('accion', 10)->nullable()->after('tipo');
            $table->json('datos')->nullable()->after('cargo');
        });
    }

    public function down(): void
    {
        Schema::table('contactos', function (Blueprint $table) {
            $table->dropColumn(['apellidos', 'cargo', 'accion', 'datos']);
            $table->enum('tipo', ['empresa', 'centro', 'alumno'])->change();
        });
    }
};
