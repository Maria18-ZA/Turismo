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
        Schema::create('reservas', function (Blueprint $table) {
             $table->id();

    $table->string('nome_user');

    $table->unsignedBigInteger('user_id')->nullable();
    $table->unsignedBigInteger('quarto_id')->nullable();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('quarto_id')->references('id')->on('quartos')->onDelete('cascade');

    $table->enum('tipo_reserva', ['simples', 'multipla'])->default('simples');
    $table->decimal('preco_total', 12, 2)->default(0);

    $table->date('checkin');
    $table->date('checkout');

    $table->enum('status', ['pendente', 'confirmada', 'cancelada'])->default('pendente');

    $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
