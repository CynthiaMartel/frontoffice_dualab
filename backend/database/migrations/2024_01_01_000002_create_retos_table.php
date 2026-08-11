<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('retos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('familia_id')->constrained()->cascadeOnDelete();
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('nivel', ['basico', 'intermedio', 'avanzado'])->default('basico');
            $table->string('duracion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('retos');
    }
};
