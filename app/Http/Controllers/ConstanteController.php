<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConstanteController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;

        $constantes = $patient->constantes()->latest()->get();

        $poids = $patient->constantes()->where('type', 'poids')->orderBy('created_at')->get(['valeur', 'created_at']);
        $tension = $patient->constantes()->where('type', 'tension')->orderBy('created_at')->get(['valeur', 'valeur_secondaire', 'created_at']);
        $glycemie = $patient->constantes()->where('type', 'glycemie')->orderBy('created_at')->get(['valeur', 'created_at']);

        return view('patient.constantes', compact('constantes', 'poids', 'tension', 'glycemie'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:tension,poids,glycemie,temperature',
            'valeur' => 'required|numeric',
            'valeur_secondaire' => 'nullable|numeric',
        ]);

        auth()->user()->patient->constantes()->create($request->only('type', 'valeur', 'valeur_secondaire'));

        return back()->with('status', 'Constante enregistrée.');
    }
}