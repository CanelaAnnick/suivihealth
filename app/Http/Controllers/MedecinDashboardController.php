<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;

class MedecinDashboardController extends Controller
{
    public function index()
    {
        $medecin = auth()->user()->medecin;

        $rdvAujourdhui = RendezVous::where('medecin_id', $medecin->id)
            ->whereDate('date_rdv', today())->count();

        $rdvEnAttente = RendezVous::where('medecin_id', $medecin->id)
            ->where('statut', 'en_attente')->count();

        $totalPatients = RendezVous::where('medecin_id', $medecin->id)
            ->distinct('patient_id')->count('patient_id');

        $prochainsRdv = RendezVous::where('medecin_id', $medecin->id)
            ->where('statut', 'confirme')
            ->whereDate('date_rdv', '>=', today())
            ->with('patient.user')
            ->orderBy('date_rdv')->orderBy('heure_rdv')
            ->take(5)->get();

        return view('dashboards.medecin', compact('rdvAujourdhui', 'rdvEnAttente', 'totalPatients', 'prochainsRdv'));
    }
}