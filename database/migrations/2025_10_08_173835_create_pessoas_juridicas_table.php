<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pessoas_juridicas', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->string('razao_social');
            $table->string('nome_fantasia')->nullable();
            $table->string('cnpj', 18)->unique();
            $table->string('email')->nullable();
            $table->string('telefone_1', 15)->nullable();
            $table->string('telefone_2', 15);

            // Relacionamento com Endereço
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos')->nullOnDelete();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pessoas_juridicas');
    }
};