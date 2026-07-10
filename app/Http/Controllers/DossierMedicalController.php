<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DossierMedicalController extends Controller
{
    public function index()
    {
        $symptomes = auth()->user()->patient->symptomes()->latest()->get();

        return view('patient.dossier-medical', compact('symptomes'));
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
}