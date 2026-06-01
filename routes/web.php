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
use App\Http\Controllers\PlaceController;
use App\Models\ImagemHotel;
use App\Models\ImagemQuarto;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


 //Web Routes

use App\Models\Place;

Route::get('/', function () {

    $places = Place::all();

    return view('welcome', compact('places'));
});


// ROTAS PÚBLICAS PARA AVALIAÇÕES (listagem – sem parâmetro wildcard)
  Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])->name('user.hoteis.avaliacoes.index');

Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])->name('avaliacoes.index');


  // Rota pública para USER ver o hotel (com avaliações)
Route::get('/hoteis/user/{id}', [HotelController::class, 'showUser'])->name('hoteis.user.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [UserController::class, 'profile'])->name('profile');
    Route::put('/perfil/user', [UserController::class, 'updateProfile'])->name('profile.update');
});
// Rota para guardar avaliação (pública)
Route::post('/hoteis/{hotel}/avaliacao', [HotelController::class, 'storeAvaliacao'])->name('hoteis.avaliacao.store');

// ROTAS PÚBLICAS PARA UTILIZADORES (prefixo 'usuario' – acesso livre)
    Route::prefix('usuario')->name('user.')->group(function () {
    Route::get('/hoteis', [UsuarioController::class, 'indexUser'])->name('hoteis.index');
    Route::get('/hoteis/{hotel}', [UsuarioController::class, 'showUser'])->name('hoteis.show');
    Route::get('/quartos/{quarto}', [UsuarioController::class, 'showQuarto'])->name('quartos.show');
    Route::get('/quartos/{quarto}/reservar', [UsuarioController::class, 'createReserva'])->name('reservas.create');
    Route::post('/reservas', [UsuarioController::class, 'storeReserva'])->name('reservas.store');
    Route::get('/pontosturisticos', [UsuarioController::class, 'indexPontos'])->name('pontosturisticos.index');
    Route::get('/pontosturisticos/{pontoTuristico}', [UsuarioController::class, 'showPontos'])->name('pontosturisticos.show');
    Route::get('/culturas', [UsuarioController::class, 'indexCultura'])->name('culturas.index');
    Route::get('/culturas/{culturas}', [UsuarioController::class, 'showCulturas'])->name('culturas.show');


Route::get('/hoteis/{hotel}/avaliar', [UsuarioController::class, 'createHotelUser'])
    ->name('hoteis.avaliar');

Route::post('/hoteis/{hotel}/avaliar', [UsuarioController::class, 'storeHotelUser'])
    ->name('hoteis.avaliar.store');

    Route::get('/pontos/{ponto}/avaliar', [UsuarioController::class, 'createPontoUser'])
    ->name('pontos.avaliar');

Route::post('/pontos/{ponto}/avaliar', [UsuarioController::class, 'storePontoUser'])
    ->name('pontos.avaliar.store');

    });

// ROTAS AUTENTICADAS (utilizadores logados)

  Route::middleware(['auth', 'verified'])->group(function () {

 // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    // ROTAS DE AVALIAÇÃO QUE EXIGEM AUTENTICAÇÃO (específicas, sem wildcard)
    
    Route::get('/avaliacoes/create', [AvaliacaoController::class, 'create'])->name('avaliacoes.create');
    Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');
    Route::get('/avaliacoes/{avaliacao}/edit', [AvaliacaoController::class, 'edit'])->name('avaliacoes.edit');
    Route::put('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'update'])->name('avaliacoes.update');
    Route::delete('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'destroy'])->name('avaliacoes.destroy');

// Gestão de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
// ROTAS PARA ADMIN e GESTOR (gestão de recursos)
    
       Route::middleware(['role:admin,gestor'])->group(function () {
        Route::resource('hoteis', HotelController::class)->parameters(['hoteis' => 'hotel' ]);
        
        
// Para hotéis
Route::delete('/hoteis/{hotel}/imagens/{imagem}', [HotelController::class, 'destroyImagem'])
     ->name('hoteis.imagens.destroy');
Route::post('/hoteis/{hotel}/imagens/{imagem}/principal', [HotelController::class, 'setPrincipal'])
     ->name('hoteis.imagens.principal');


        Route::resource('quartos', QuartoController::class);

        // Para quartos (se quiser igual)


Route::get('/quartos/public/{id}', [QuartoController::class, 'showUser'])->name('quartos.showUser');
Route::delete('/quartos/{quarto}/imagens/{imagemId}', [QuartoController::class, 'destroyImagem'])->name('quartos.imagens.destroy');
Route::post('/quartos/{quarto}/imagens/{imagemId}/principal', [QuartoController::class, 'setPrincipal'])->name('quartos.imagens.principal');

        Route::resource('reservas', ReservaController::class);
        Route::resource('servicos', ServicoController::class);
        Route::resource('pontosturisticos', PontoTuristicoController::class)->parameters([
    'pontosturisticos' => 'pontoTuristico']);

    // Para quartos (se quiser igual)
Route::delete('/pontos/{ponto}/imagens/{imagem}', [PontoTuristicoController::class, 'destroyImagem'])
     ->name('pontos.imagens.destroy');
Route::post('/pontos/{ponto}/imagens/{imagem}/principal', [PontoTuristicoController::class, 'setPrincipal'])
     ->name('pontos.imagens.principal');
     
        Route::resource('culturas', CulturaController::class);

        // Para quartos (se quiser igual)
Route::delete('/culturas/{cultura}/imagens/{imagem}', [CulturaController::class, 'destroyImagem'])
     ->name('culturas.imagens.destroy');
Route::post('/culturas/{cultura}/imagens/{imagem}/principal', [CulturaController::class, 'setPrincipal'])
     ->name('culturas.imagens.principal');
     

        Route::resource('places', PlaceController::class);

// Ações específicas de reserva
        Route::post('reservas/{reserva}/confirm', [ReservaController::class, 'confirm'])->name('reservas.confirm');
        Route::post('reservas/{reserva}/cancel', [ReservaController::class, 'cancel'])->name('reservas.cancel');
    });

   
// ROTAS APENAS PARA ADMIN (gestão de utilizadores)
   
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});

// ROTA PÚBLICA DE DETALHE DE AVALIAÇÃO (COM WILDCARD) – DEVE SER A ÚLTIMA

  Route::get('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'show'])->name('avaliacoes.show');

// Incluir rotas de autenticação (login, registo, etc.)
   require __DIR__.'/auth.php';