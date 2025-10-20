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
            $table->string('nacionalidade')->default('Brasileiro(a)');
            $table->string('nome');
            $table->string('cpf_cin', 14)->unique();
            $table->string('crg', 14)->nullable()->unique();
            $table->string('crnm', 9)->nullable()->unique();
            $table->string('passaporte', 9)->nullable()->unique();
            $table->string('estado_civil')->nullable();
            $table->string('profissao')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone', 15);

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