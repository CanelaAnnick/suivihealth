<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $hopitalId = auth()->user()->hopital_id;

        $totalMedecins = Medecin::where('hopital_id', $hopitalId)->count();
        $medecinsActifs = Medecin::where('hopital_id', $hopitalId)->where('statut', 'actif')->count();

        $patientIds = RendezVous::whereHas('medecin', fn ($q) => $q->where('hopital_id', $hopitalId))->distinct()->pluck('patient_id');
        $totalPatients = Patient::whereIn('id', $patientIds)->count();

        $derniersMedecins = Medecin::where('hopital_id', $hopitalId)->with('user')->latest()->take(5)->get();

        return view('dashboards.admin', compact('totalMedecins', 'medecinsActifs', 'totalPatients', 'derniersMedecins'));
    }

    public function statistiques()
    {
        $hopitalId = auth()->user()->hopital_id;

        $consultationsParSemaine = collect(range(7, 0))->map(function ($i) use ($hopitalId) {
            $debut = now()->subWeeks($i)->startOfWeek();
            $fin = now()->subWeeks($i)->endOfWeek();
            return [
                'label' => $debut->format('d/m'),
                'count' => RendezVous::whereHas('medecin', fn ($q) => $q->where('hopital_id', $hopitalId))
                    ->whereBetween('created_at', [$debut, $fin])->count(),
            ];
        });

        $parSpecialite = RendezVous::join('medecins', 'rendez_vous.medecin_id', '=', 'medecins.id')
            ->where('medecins.hopital_id', $hopitalId)
            ->selectRaw('medecins.specialite, count(*) as total')
            ->groupBy('medecins.specialite')->get();

        return view('admin.statistiques', compact('consultationsParSemaine', 'parSpecialite'));
    }
}