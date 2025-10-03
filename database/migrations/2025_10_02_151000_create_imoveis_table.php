<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();

            // Características do imóvel
            $table->string('lote')->nullable();
            $table->string('quadra')->nullable();
            $table->string('nucleo_urbano')->nullable(); // núcleo urbano informal
            $table->string('matricula')->nullable();
            $table->date('data_prenotacao')->nullable();

            // Endereço do imóvel
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
        Schema::dropIfExists('imoveis');
    }
};