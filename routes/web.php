<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PontoTuristicoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\CulturaController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

// Routes para usuários comuns
Route::get('us', [HotelController::class, 'indexUser']);

Route::resource('hoteis', HotelController::class)->parameters(['hoteis' => 'hotel']);

Route::resource('quartos', QuartoController::class);
// Rotas para administração

// Perfil do user
Route::get('/',function(){
    return view('welcome');
});
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('hoteis', HotelController::class)->parameters(['hoteis' => 'hotel']);
});


Route::resource('pontosturisticos', PontoTuristicoController::class)    ->parameters(['pontosturisticos' => 'pontoTuristico']);
    Route::resource('servicos', ServicoController::class)->parameters(['servicos' => 'servico']);

Route::resource('avaliacoes', AvaliacaoController::class);
Route::resource('quartos', QuartoController::class);
Route::resource('culturas', CulturaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('users', UserController::class);
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
});
Route::resource('users', UserController::class);
require __DIR__.'/auth.php';