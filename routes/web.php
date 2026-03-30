<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PontoTuristicoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('hoteis', HotelController::class)
    ->parameters(['hoteis' => 'hotel']);

Route::resource('pontosturisticos', PontoTuristicoController::class)
    ->parameters(['pontosturisticos' => 'pontoTuristico']);

    Route::resource('servicos', ServicoController::class)
    ->parameters(['servicos' => 'servico']);
Route::resource('avaliacoes', AvaliacaoController::class);
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
});
require __DIR__.'/auth.php';