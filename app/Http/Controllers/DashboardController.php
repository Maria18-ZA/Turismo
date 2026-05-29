<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reserva;
use App\Models\Avaliacao;
use App\Models\Quarto;
use App\Models\Servico;
use App\Models\PontoTuristico;
use App\Models\Cultura;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // ============================================
        // 1. DADOS AGREGADOS POR ROLE
        // ============================================

        if ($user->role === 'admin') {
            // ADMIN: vê tudo
            $totalHoteis      = Hotel::count();
            $totalReservas    = Reserva::count();
            $totalPontos      = PontoTuristico::count();
            $totalUtilizadores = User::count();
            $totalServicos    = Servico::count();
            $totalQuartos     = Quarto::count();
            $totalCulturas    = Cultura::count();
            $totalAvaliacoes  = Avaliacao::count();

            // Reservas recentes (todas)
            $reservasRecentes = Reserva::with(['user', 'quartos.hotel'])
                ->latest()
                ->take(10)
                ->get();

            // Avaliações recentes (todas)
            $avaliacoesRecentes = Avaliacao::with('hotel')
                ->latest()
                ->take(5)
                ->get();
        } 
        elseif ($user->role === 'gestor') {
            // GESTOR: vê apenas dados relacionados aos seus hotéis
            $hoteisDoGestor = Hotel::where('user_id', $user->id)->pluck('id');

            $totalHoteis      = $hoteisDoGestor->count();
            $totalReservas    = Reserva::whereHas('quartos.hotel', function($q) use ($hoteisDoGestor) {
                                    $q->whereIn('hoteis.id', $hoteisDoGestor);
                                })->count();
            $totalQuartos     = Quarto::whereIn('hotel_id', $hoteisDoGestor)->count();
            $totalAvaliacoes  = Avaliacao::whereIn('hotel_id', $hoteisDoGestor)->count();
            $totalServicos    = Servico::whereIn('hotel_id', $hoteisDoGestor)->count();

            // Pontos turísticos, culturas, utilizadores – o gestor NÃO vê totais globais
            // (pode deixar zero ou mostrar apenas os relacionados, mas normalmente não são do seu âmbito)
            $totalPontos       = 0;
            $totalUtilizadores = 0;
            $totalCulturas     = 0;

            // Reservas recentes dos seus hotéis
            $reservasRecentes = Reserva::with(['user', 'quartos.hotel'])
                ->whereHas('quartos.hotel', function($q) use ($hoteisDoGestor) {
                    $q->whereIn('hoteis.id', $hoteisDoGestor);
                })
                ->latest()
                ->take(10)
                ->get();

            // Avaliações recentes dos seus hotéis
            $avaliacoesRecentes = Avaliacao::with('hotel')
                ->whereIn('hotel_id', $hoteisDoGestor)
                ->latest()
                ->take(5)
                ->get();
        } 
        else { // TURISTA
            // Turista: vê apenas as suas próprias reservas e avaliações
            $totalReservas    = Reserva::where('user_id', $user->id)->count();
            $totalAvaliacoes  = Avaliacao::where('user_id', $user->id)
                                  ->orWhere('email', $user->email)
                                  ->count();

            // Outros totais não são relevantes para o turista (pode mostrar 0 ou omitir)
            $totalHoteis      = 0;
            $totalPontos      = 0;
            $totalUtilizadores = 0;
            $totalServicos    = 0;
            $totalQuartos     = 0;
            $totalCulturas    = 0;

            // Reservas recentes do turista
            $reservasRecentes = Reserva::with(['quartos.hotel'])
                ->where('user_id', $user->id)
                ->latest()
                ->take(10)
                ->get();

            // Avaliações recentes do turista
            $avaliacoesRecentes = Avaliacao::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->latest()
                ->take(5)
                ->get();
        }

        // ============================================
        // 2. PASSAR VARIÁVEIS PARA A VIEW
        // ============================================

        return view('dashboard', compact(
            'totalHoteis',
            'totalReservas',
            'totalPontos',
            'totalUtilizadores',
            'totalServicos',
            'totalQuartos',
            'totalCulturas',
            'totalAvaliacoes',
            'reservasRecentes',
            'avaliacoesRecentes'
        ));
    }
}