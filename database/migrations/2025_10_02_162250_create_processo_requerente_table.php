<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('processo_requerente', function (Blueprint $table) {
            $table->id();

            // Chaves estrangeiras
            $table->foreignId('processo_id')->constrained()->onDelete('cascade');
            $table->foreignId('requerente_id')->constrained()->onDelete('cascade');

            // Timestamps
            $table->timestamps();
            
            // Evitar duplicidade
            $table->unique(['processo_id', 'requerente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('processo_requerente');
    }
};