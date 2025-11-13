<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pessoas_fisicas', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->string('nome');
            $table->string('genero');
            $table->string('pais_origem');
            $table->string('nacionalidade')->default('Brasileiro(a)');
            $table->string('cpf_cin', 14)->unique();
            $table->string('rg')->nullable()->unique();
            $table->string('rne_crnm', 14)->nullable()->unique();
            $table->string('cnh', 9)->nullable()->unique();
            $table->string('passaporte', 9)->nullable()->unique();
            $table->string('estado_civil')->nullable();
            $table->string('profissao')->nullable();
            $table->string('telefone_1', 15);
            $table->string('telefone_2', 15)->nullable();
            $table->string('email')->nullable();

            // Chave estrangeira
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos')->nullOnDelete();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pessoas_fisicas');
    }
};