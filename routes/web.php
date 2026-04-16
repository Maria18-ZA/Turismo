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

//
// 🔹 ROTAS PÚBLICAS (USER)
//
Route::prefix('user')->group(function () {

    // Lista de hotéis
    Route::get('/hoteis', [HotelController::class, 'indexUser'])
        ->name('user.hoteis.index');

    // Ver hotel
    Route::get('/hoteis/{hotel}', [HotelController::class, 'showUser'])
        ->name('user.hoteis.show');
});

//
// 🔹 HOME (podes redirecionar para user)
//
Route::get('/', function () {
    return redirect()->route('user.hoteis.index');
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