<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('hotel_id')->nullable()->constrained('hoteis')->onDelete('cascade');
            $table->foreignId('pontoturistico_id')->nullable()->constrained('pontos_turisticos')->onDelete('cascade');
            $table->string('email');
            $table->text('comentario')->nullable();
            $table->integer('nota');
            $table->timestamps();

            // Opcional: índice para evitar duplicados (um email só pode avaliar um hotel/ponto uma vez)
            $table->unique(['email', 'hotel_id']);
            $table->unique(['email', 'pontoturistico_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};