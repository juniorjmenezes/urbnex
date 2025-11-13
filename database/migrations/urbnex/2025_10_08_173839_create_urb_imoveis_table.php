<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('urb_imoveis', function (Blueprint $table) {
            $table->id();

            // Características do Imóvel
            $table->string('nucleo_urbano')->nullable();
            $table->string('quadra')->nullable();
            $table->string('matricula')->nullable();
            $table->date('data_prenotacao')->nullable();
            $table->string('lote')->nullable();
            $table->string('area')->nullable();
            $table->string('area_edificada')->nullable();
            $table->string('perimetro')->nullable();
            $table->string('art')->nullable();

            // Coordenadas geográficas
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            
            // Relacionamento com Endereço
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos')->nullOnDelete();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urb_imoveis');
    }
};