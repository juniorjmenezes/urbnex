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
            $table->string('nucleo_urbano')->nullable();
            $table->string('quadra')->nullable();
            $table->string('matricula')->nullable();
            $table->date('data_prenotacao')->nullable();
            $table->string('lote')->nullable();
            $table->string('area')->nullable();
            $table->string('area_edificada')->nullable();
            $table->string('perimetro')->nullable();
            $table->string('art')->nullable();

            // Endereço do imóvel
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();

            // Chave estrangeira
            $table->foreignId('processo_id')->constrained()->onDelete('cascade');

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imoveis');
    }
};