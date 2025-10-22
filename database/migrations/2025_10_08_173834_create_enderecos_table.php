<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->string('cep', 9);
            $table->string('logradouro', 255);
            $table->string('numero', 10);
            $table->string('complemento', 255)->nullable();
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('estado', 2);
            
            // Timestamps
            $table->timestamps();
        });
    }

    // Endereços
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};