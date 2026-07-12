<?php

namespace App\Http\Controllers;

use App\Models\Plainte;
use Illuminate\Http\Request;

class AdminPlainteController extends Controller
{
    public function index()
    {
        $plaintes = Plainte::with('patient.user', 'rendezVous.medecin.user')->latest()->get();

        return view('admin.plaintes', compact('plaintes'));
    }

    public function update(Request $request, Plainte $plainte)
    {
        $request->validate([
            'statut' => 'required|in:nouvelle,en_cours,resolue',
            'reponse_admin' => 'nullable|string',
        ]);

        $plainte->update($request->only('statut', 'reponse_admin'));

        \App\Models\Notification::create([
            'user_id' => $plainte->patient->user_id,
            'titre' => 'Réponse à votre réclamation',
            'message' => $request->reponse_admin ?: 'Votre réclamation a été mise à jour : '.$plainte->statut,
        ]);

        return back()->with('status', 'Réclamation mise à jour.');
    }
}