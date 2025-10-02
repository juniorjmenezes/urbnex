<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->string('nome');
            $table->string('cpf', 20)->nullable();
            $table->string('rg', 20)->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('profissao')->nullable();
            $table->string('endereco')->nullable();

            // Chaves estrangeiras
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');

            // Timestamps
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('representantes');
    }
};