<?php

namespace App\Http\Controllers;

use App\Models\Plainte;
use Illuminate\Http\Request;

class PatientPlainteController extends Controller
{
    public function index()
    {
        $plaintes = auth()->user()->patient->plaintes()->with('rendezVous.medecin.user')->latest()->get();
        $rendezVous = auth()->user()->patient->rendezVous()->with('medecin.user')->latest()->take(20)->get();

        return view('patient.plaintes', compact('plaintes', 'rendezVous'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sujet' => 'required|string|max:255',
            'message' => 'required|string',
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
        ]);
    
        auth()->user()->patient->plaintes()->create($request->only('sujet', 'message', 'rendez_vous_id'));
    
        return back()->with('status', 'Votre réclamation a été envoyée à l\'hôpital concerné.');
    }
}