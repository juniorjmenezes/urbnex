<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requerentes', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->enum('tipo', ['PF', 'PJ'])->default('PF'); // pessoa física ou jurídica
            $table->string('nome'); // nome ou razão social
            $table->string('cpf_cnpj', 20)->unique(); // CPF ou CNPJ
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requerentes');
    }
};