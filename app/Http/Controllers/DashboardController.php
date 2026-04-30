<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reserva;
use App\Models\PontoTuristico;
use App\Models\User;
use App\Models\Servico;
use App\Models\Quarto;
use App\Models\Cultura;
use App\Models\Avaliacao;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalHoteis'        => Hotel::count(),
            'totalReservas'      => Reserva::count(),
            'totalPontos'        => PontoTuristico::count(),
            'totalUtilizadores'  => User::count(),
            'totalServicos'      => Servico::count(),
            'totalQuartos'       => Quarto::count(),
            'totalCulturas'      => Cultura::count(),
            'totalAvaliacoes'    => Avaliacao::count(),
            'reservasRecentes'   => Reserva::with('user', 'hotel')->latest()->take(5)->get(),
            'avaliacoesRecentes' => Avaliacao::with('user')->latest()->take(4)->get(),
        ]);
    }
}