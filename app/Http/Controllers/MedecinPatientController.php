<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;

class MedecinPatientController extends Controller
{
    public function index()
    {
        $medecinId = auth()->user()->medecin->id;

        $patientIds = RendezVous::where('medecin_id', $medecinId)
            ->distinct()->pluck('patient_id');

        $patients = Patient::with('user')
            ->whereIn('id', $patientIds)
            ->withCount('symptomes')
            ->get();

        return view('medecin.patients', compact('patients'));
    }

    public function show(Patient $patient)
    {
        abort_unless($patient->aConsulteAvec(auth()->user()->medecin->id), 403);

        $symptomes = $patient->symptomes()->latest()->get();
        $constantes = $patient->constantes()->latest()->take(10)->get();
        $ordonnances = $patient->ordonnances()->where('medecin_id', auth()->user()->medecin->id)->latest('date_prescription')->get();

        return view('medecin.patient-detail', compact('patient', 'symptomes', 'constantes', 'ordonnances'));
    }
}