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
        Schema::create('imagens_quartos', function (Blueprint $table) {
        $table->id();
        $table->string('imagem')->nullable();

       $table->foreignId('quarto_id')
      ->constrained('quartos')
      ->onDelete('cascade');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imagens_quartos', function (Blueprint $table) {
            //
        });
    }
};
