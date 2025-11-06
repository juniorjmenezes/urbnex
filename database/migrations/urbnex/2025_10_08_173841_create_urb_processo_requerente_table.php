<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('urb_processo_requerente', function (Blueprint $table) {
            $table->id();

            // Chaves estrangeiras com prefixo explícito
            $table->foreignId('processo_id')
                  ->constrained('urb_processos')
                  ->onDelete('cascade');

            $table->foreignId('requerente_id')
                  ->constrained('urb_requerentes')
                  ->onDelete('cascade');

            // Timestamps
            $table->timestamps();

            // Evitar duplicidade
            $table->unique(['processo_id', 'requerente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urb_processo_requerente');
    }
};