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
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rota inicial pública
Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// ROTAS PÚBLICAS PARA AVALIAÇÕES (listagem – sem parâmetro wildcard)
// =========================================================================
Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])->name('avaliacoes.index');

// =========================================================================
// ROTAS PÚBLICAS PARA UTILIZADORES (prefixo 'usuario' – acesso livre)
// =========================================================================
Route::prefix('usuario')->name('user.')->group(function () {
    Route::get('/hoteis', [UsuarioController::class, 'indexUser'])->name('hoteis.index');
    Route::get('/hoteis/{hotel}', [UsuarioController::class, 'showUser'])->name('hoteis.show');
    Route::get('/quartos/{quarto}', [UsuarioController::class, 'showQuarto'])->name('quartos.show');
    Route::get('/pontosturisticos', [UsuarioController::class, 'indexPontos'])->name('pontosturisticos.index');
    Route::get('/pontosturisticos/{pontoTuristico}', [UsuarioController::class, 'showPontos'])->name('pontosturisticos.show');
    Route::get('/culturas', [UsuarioController::class, 'indexCultura'])->name('culturas.index');
    Route::get('/culturas/{Culturas}', [UsuarioController::class, 'showCulturas'])->name('culturas.show');
});

// =========================================================================
// ROTAS AUTENTICADAS (utilizadores logados)
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =====================================================================
    // ROTAS DE AVALIAÇÃO QUE EXIGEM AUTENTICAÇÃO (específicas, sem wildcard)
    // =====================================================================
    Route::get('/avaliacoes/create', [AvaliacaoController::class, 'create'])->name('avaliacoes.create');
    Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');
    Route::get('/avaliacoes/{avaliacao}/edit', [AvaliacaoController::class, 'edit'])->name('avaliacoes.edit');
    Route::put('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'update'])->name('avaliacoes.update');
    Route::delete('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'destroy'])->name('avaliacoes.destroy');

    // Gestão de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =====================================================================
    // ROTAS PARA ADMIN e GESTOR (gestão de recursos)
    // =====================================================================
    Route::middleware(['role:admin,gestor'])->group(function () {
        Route::resource('hoteis', HotelController::class);
        Route::resource('quartos', QuartoController::class);
        Route::resource('reservas', ReservaController::class);
        Route::resource('servicos', ServicoController::class);
        Route::resource('pontosturisticos', PontoTuristicoController::class);
        Route::resource('culturas', CulturaController::class);

        // Ações específicas de reserva
        Route::post('reservas/{reserva}/confirm', [ReservaController::class, 'confirm'])->name('reservas.confirm');
        Route::post('reservas/{reserva}/cancel', [ReservaController::class, 'cancel'])->name('reservas.cancel');
    });

    // =====================================================================
    // ROTAS APENAS PARA ADMIN (gestão de utilizadores)
    // =====================================================================
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

// =========================================================================
// ROTA PÚBLICA DE DETALHE DE AVALIAÇÃO (COM WILDCARD) – DEVE SER A ÚLTIMA
// =========================================================================
Route::get('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'show'])->name('avaliacoes.show');

// Incluir rotas de autenticação (login, registo, etc.)
require __DIR__.'/auth.php';