<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class MedecinPatientController extends Controller
{
    public function index(Request $request)
    {
        $medecinId = auth()->user()->medecin->id;
    
        $patientIds = RendezVous::where('medecin_id', $medecinId)->distinct()->pluck('patient_id');
    
        $query = Patient::with('user')->whereIn('id', $patientIds)->withCount('symptomes');
    
        if ($request->filled('recherche')) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$request->recherche.'%'));
        }
    
        $patients = $query->get()->map(function ($p) use ($medecinId) {
            $p->derniere_consultation = RendezVous::where('patient_id', $p->id)
                ->where('medecin_id', $medecinId)->latest('created_at')->value('created_at');
            return $p;
        });
    
        $patients = $request->get('tri') === 'recent'
            ? $patients->sortByDesc('derniere_consultation')->values()
            : $patients->sortBy(fn ($p) => $p->user->name)->values();
    
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