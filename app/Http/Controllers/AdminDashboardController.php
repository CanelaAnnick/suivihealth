<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalMedecins = Medecin::count();
        $medecinsActifs = Medecin::where('statut', 'actif')->count();
        $totalPatients = Patient::count();
        $derniersMedecins = Medecin::with('user')->latest()->take(5)->get();

        return view('dashboards.admin', compact('totalMedecins', 'medecinsActifs', 'totalPatients', 'derniersMedecins'));
    }
    public function statistiques()
    {
        $consultationsParSemaine = collect(range(7, 0))->map(function ($i) {
            $debut = now()->subWeeks($i)->startOfWeek();
            $fin = now()->subWeeks($i)->endOfWeek();
            return [
                'label' => $debut->format('d/m'),
                'count' => \App\Models\RendezVous::whereBetween('created_at', [$debut, $fin])->count(),
            ];
        });
    
        $parSpecialite = \App\Models\RendezVous::join('medecins', 'rendez_vous.medecin_id', '=', 'medecins.id')
            ->selectRaw('medecins.specialite, count(*) as total')
            ->groupBy('medecins.specialite')->get();
    
        return view('admin.statistiques', compact('consultationsParSemaine', 'parSpecialite'));
    }
}