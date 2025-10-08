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
            $table->enum('tipo', ['PF', 'PJ']);
            $table->foreignId('pessoa_fisica_id')->nullable()->constrained('pessoas_fisicas')->nullOnDelete();
            $table->foreignId('pessoa_juridica_id')->nullable()->constrained('pessoas_juridicas')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requerentes');
    }
};