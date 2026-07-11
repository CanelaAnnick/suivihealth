<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;

class MedecinRendezVousController extends Controller
{
    public function index()
    {
        $medecinId = auth()->user()->medecin->id;

        $enAttente = RendezVous::where('medecin_id', $medecinId)
            ->where('statut', 'en_attente')->with('patient.user')->latest()->get();

        $confirmes = RendezVous::where('medecin_id', $medecinId)
            ->where('statut', 'confirme')->with('patient.user')
            ->orderByRaw('date_rdv IS NULL, date_rdv, heure_rdv')->get();

        return view('medecin.rendezvous', compact('enAttente', 'confirmes'));
    }
}