<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->string('numero')->unique();
            $table->date('data_abertura')->nullable();
            $table->text('observacoes')->nullable();

            // Chaves estrangeiras
            $table->foreignId('imovel_id')->unique()->constrained('imoveis')->onDelete('cascade');
            $table->foreignId('pessoa_juridica_id')->constrained('pessoas_juridicas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('processos');
    }
};