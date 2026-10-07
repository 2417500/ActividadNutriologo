<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;

class DashboardController extends Controller
{
    public function nutriologo()
    {
        $totalPacientes = Paciente::whereHas('user', function ($consulta) {
            $consulta->where('activo', true);
        })->count();

        $citasPendientes = Cita::where('estado', 'pendiente')
            ->whereDate('fecha', '>=', today())
            ->count();

        $citasHoy = Cita::with('paciente.user')
            ->whereDate('fecha', today())
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->orderBy('hora')
            ->get();

        return view('nutriologo.dashboard', compact(
            'totalPacientes',
            'citasPendientes',
            'citasHoy'
        ));
    }

    public function paciente()
    {
        $paciente = auth()->user()->paciente;

        abort_unless(
            $paciente,
            403,
            'No existe un perfil de paciente asociado.'
        );

        $proximasCitas = $paciente->citas()
            ->whereDate('fecha', '>=', today())
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        $ultimaCita = $paciente->citas()
            ->where('estado', 'completada')
            ->with('evaluacion')
            ->orderByDesc('fecha')
            ->first();

        $expediente = $paciente->expediente;

        return view('paciente.dashboard', compact(
            'paciente',
            'proximasCitas',
            'ultimaCita',
            'expediente'
        ));
    }
}