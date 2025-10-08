<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('andamentos', function (Blueprint $table) {
            $table->id();

            // Campos principais
            $table->date('data')->nullable();
            $table->string('status', 100);
            $table->text('complemento')->nullable();

            // Chaves estrangeiras
            $table->foreignId('processo_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('andamentos');
    }
};