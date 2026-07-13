<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DossierMedicalController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;
        $symptomes = $patient->symptomes()->latest()->get();
        $vaccinations = $patient->vaccinations()->latest('date_administration')->get();
    
        return view('patient.dossier-medical', compact('symptomes', 'vaccinations', 'patient'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'gravite' => 'required|in:legere,moderee,severe',
        ]);

        auth()->user()->patient->symptomes()->create($request->only('titre', 'description', 'gravite'));

        return back()->with('status', 'Symptôme ajouté avec succès.');
    }
    public function exportPdf()
    {
        $patient = auth()->user()->patient;
        $symptomes = $patient->symptomes()->latest()->get();
        $constantes = $patient->constantes()->latest()->get();
    
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.dossier-medical', compact('patient', 'symptomes', 'constantes'));
    
        return $pdf->download('dossier-medical-'.now()->format('d-m-Y').'.pdf');
    }
    public function destroySymptome(\App\Models\Symptome $symptome)
    {
        abort_if($symptome->patient_id !== auth()->user()->patient->id, 403);
        $symptome->delete();
        return back()->with('status', 'Symptôme supprimé.');
    }
    public function updateAllergies(Request $request)
    {
        $request->validate(['allergies' => 'nullable|string']);
        auth()->user()->patient->update(['allergies' => $request->allergies]);
        return back()->with('status', 'Allergies mises à jour.');
    }

    public function exportCarnet()
    {
        $patient = auth()->user()->patient;
        $symptomes = $patient->symptomes()->latest()->get();
        $constantes = $patient->constantes()->latest()->get();
        $vaccinations = $patient->vaccinations()->latest('date_administration')->get();
        $ordonnances = $patient->ordonnances()->with('medecin.user')->latest('date_prescription')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.carnet-sante', compact('patient', 'symptomes', 'constantes', 'vaccinations', 'ordonnances'));

        return $pdf->download('carnet-sante-'.\Illuminate\Support\Str::slug($patient->user->name).'.pdf');
    }
}