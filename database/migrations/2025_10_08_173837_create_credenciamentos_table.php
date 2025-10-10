<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credenciamentos', function (Blueprint $table) {
            $table->id();

            // Dados do credenciamento
            $table->date('data_credenciamento')->nullable();
            $table->date('validade')->nullable();
            $table->enum('situacao', ['ativa', 'inativa', 'suspensa'])->default('ativa');
            $table->text('observacoes')->nullable();

            // Chave estrangeira
            $table->foreignId('pessoa_juridica_id')->constrained('pessoas_juridicas')->onDelete('cascade');
            
            // Timestamps
            $table->timestamps();

            // Garante que uma empresa não seja credenciada mais de uma vez
            $table->unique('pessoa_juridica_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credenciadas');
    }
};