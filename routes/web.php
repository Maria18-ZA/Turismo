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
use Illuminate\Support\Facades\Route;

//
// 🔹 ROTAS PÚBLICAS (USER)
//
Route::prefix('usuario')->group(function () {

    // Lista de hotéis
    Route::get('/hoteis', [UsuarioController::class, 'indexUser'])
        ->name('user.hoteis.index');

    // Ver hotel
    Route::get('/hoteis/{hotel}', [UsuarioController::class, 'showUser'])
        ->name('user.hoteis.show');

    // Ver quarto
    Route::get('/quartos/{quarto}', [UsuarioController::class, 'showQuarto'])
        ->name('user.quartos.show');

    // Criar reserva
    Route::get('/reservas/create', [UsuarioController::class, 'create'])
        ->name('user.reservas.create');
});

//
// 🔹 HOME (podes redirecionar para user)
Route::get('/', function () {
    return view('welcome');
});

//
// 🔹 ROTAS AUTENTICADAS (ADMIN)
//
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD ADMIN
    Route::resource('hoteis', HotelController::class)->parameters([
    'hoteis' => 'hotel'
]);
    Route::resource('quartos', QuartoController::class);
    Route::resource('reservas', ReservaController::class);
    Route::resource('culturas', CulturaController::class);
    Route::resource('avaliacoes', AvaliacaoController::class);
    Route::resource('servicos', ServicoController::class);
    Route::resource('pontosturisticos', PontoTuristicoController::class);

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//
// 🔹 USERS (APENAS UMA VEZ)
//
Route::resource('users', UserController::class);

//
// 🔹 AUTH
//
require __DIR__.'/auth.php';