<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imagens_pontosturisticos', function (Blueprint $table) {
            $table->id();
            $table->string('imagem')->nullable();
            $table->unsignedBigInteger('pontoturistico_id');
            $table->foreign('pontoturistico_id')->references('id')->on('pontos_turisticos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagens_pontosturisticos');
    }
};
