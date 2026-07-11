<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;

class SuperAdminStatistiquesController extends Controller
{
    public function index()
    {
        $consultationsParSemaine = collect(range(7, 0))->map(function ($i) {
            $debut = now()->subWeeks($i)->startOfWeek();
            $fin = now()->subWeeks($i)->endOfWeek();
            return [
                'label' => $debut->format('d/m'),
                'count' => RendezVous::whereBetween('created_at', [$debut, $fin])->count(),
            ];
        });

        $parSpecialite = RendezVous::join('medecins', 'rendez_vous.medecin_id', '=', 'medecins.id')
            ->selectRaw('medecins.specialite, count(*) as total')
            ->groupBy('medecins.specialite')->get();

        return view('superadmin.statistiques', compact('consultationsParSemaine', 'parSpecialite'));
    }
}