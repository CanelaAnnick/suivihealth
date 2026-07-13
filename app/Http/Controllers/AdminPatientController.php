<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class AdminPatientController extends Controller
{
    protected function patientIdsDeLHopital()
    {
        return RendezVous::whereHas('medecin', fn ($q) => $q->where('hopital_id', auth()->user()->hopital_id))
            ->distinct()->pluck('patient_id');
    }

    public function index(Request $request)
    {
        $query = Patient::with('user')->whereIn('id', $this->patientIdsDeLHopital());

        if ($request->filled('recherche')) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$request->recherche.'%'));
        }

        $patients = $query->latest()->get();

        return view('admin.patients', compact('patients'));
    }

    public function show(Patient $patient)
    {
        abort_unless($this->patientIdsDeLHopital()->contains($patient->id), 403);

        $symptomes = $patient->symptomes()->latest()->get();
        $constantes = $patient->constantes()->latest()->take(10)->get();
        $ordonnances = $patient->ordonnances()->with('medecin.user')->latest('date_prescription')->get();
        $rendezVous = $patient->rendezVous()->with('medecin.user')->latest()->take(10)->get();

        return view('admin.patient-detail', compact('patient', 'symptomes', 'constantes', 'ordonnances', 'rendezVous'));
    }

    public function exportPdf(Patient $patient)
    {
        abort_unless($this->patientIdsDeLHopital()->contains($patient->id), 403);

        $symptomes = $patient->symptomes()->latest()->get();
        $constantes = $patient->constantes()->latest()->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.dossier-medical', compact('patient', 'symptomes', 'constantes'));

        return $pdf->download('dossier-'.\Illuminate\Support\Str::slug($patient->user->name).'.pdf');
    }
}