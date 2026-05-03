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
        Schema::create('imagens_culturas', function (Blueprint $table) {
    $table->id();
    $table->string('imagem')->nullable();
    $table->unsignedBigInteger('cultura_id');

    $table->foreign('cultura_id')
          ->references('id')
          ->on('culturas')
          ->onDelete('cascade');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
   
    Schema::dropIfExists('imagens_culturas');
    Schema::dropIfExists('culturas');
    }
};
