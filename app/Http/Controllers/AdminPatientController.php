<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class AdminPatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::with('user');

        if ($request->filled('recherche')) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$request->recherche.'%'));
        }

        $patients = $query->latest()->get();

        return view('admin.patients', compact('patients'));
    }

    public function show(Patient $patient)
    {
        $symptomes = $patient->symptomes()->latest()->get();
        $constantes = $patient->constantes()->latest()->take(10)->get();
        $ordonnances = $patient->ordonnances()->with('medecin.user')->latest('date_prescription')->get();
        $rendezVous = $patient->rendezVous()->with('medecin.user')->latest()->take(10)->get();

        return view('admin.patient-detail', compact('patient', 'symptomes', 'constantes', 'ordonnances', 'rendezVous'));
    }
}