<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedecinOrdonnanceController extends Controller
{
    public function index()
    {
        $ordonnances = Ordonnance::where('medecin_id', auth()->user()->medecin->id)
            ->with('patient.user')->latest('date_prescription')->get();

        return view('medecin.ordonnances', compact('ordonnances'));
    }

    public function create(Patient $patient)
    {
        abort_unless($patient->aConsulteAvec(auth()->user()->medecin->id), 403);

        return view('medecin.ordonnance-create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
        abort_unless($patient->aConsulteAvec(auth()->user()->medecin->id), 403);

        $request->validate([
            'medicaments' => 'required|string',
            'instructions' => 'nullable|string',
        ]);

        $ordonnance = Ordonnance::create([
            'patient_id' => $patient->id,
            'medecin_id' => auth()->user()->medecin->id,
            'medicaments' => $request->medicaments,
            'instructions' => $request->instructions,
            'date_prescription' => now(),
        ]);

        \App\Models\Notification::create([
            'user_id' => $patient->user_id,
            'titre' => 'Nouvelle ordonnance',
            'message' => 'Dr. '.auth()->user()->name.' vous a prescrit une ordonnance.',
        ]);

        return redirect()->route('medecin.patients.show', $patient)->with('status', 'Ordonnance créée avec succès.');
    }
}