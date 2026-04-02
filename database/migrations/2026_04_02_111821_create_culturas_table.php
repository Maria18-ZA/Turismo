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
        Schema::create('culturas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('tipo', ['tradicional', 'moderna'])->nullable();
            $table->text('descicao')->nullable();
            $table->string('localizacao')->nullable();
            $table->date('data_celebracao')->nullable();
            $table->string('foto_capa')->nullable();
            $table->string('origem_etnica')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culturas');
    }
};
