<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('urb_representantes', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->string('nome');
            $table->string('cpf_cin', 20)->nullable();
            $table->string('rg', 20)->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('profissao')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();

            // Chaves estrangeiras
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos')->nullOnDelete();
            $table->foreignId('pessoa_juridica_id')->constrained('pessoas_juridicas')->onDelete('cascade');

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urb_representantes');
    }
};
