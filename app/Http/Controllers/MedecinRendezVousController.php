<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\RendezVous;

class MedecinRendezVousController extends Controller
{
    public function index()
    {
        $medecinId = auth()->user()->medecin->id;
    
        $enAttente = RendezVous::where('medecin_id', $medecinId)
            ->where('type', 'immediat')->where('statut', 'en_attente')
            ->where('statut_paiement', 'paye')
            ->with('patient.user')->latest()->get();
    
        $aReprogrammer = RendezVous::where('medecin_id', $medecinId)
            ->where('statut', 'a_reprogrammer')
            ->with('patient.user')->latest()->get();
    
        $confirmes = RendezVous::where('medecin_id', $medecinId)
            ->where('statut', 'confirme')->with('patient.user')
            ->orderByRaw('date_rdv IS NULL, date_rdv, heure_rdv')->get();
    
        $historique = RendezVous::where('medecin_id', $medecinId)
            ->whereIn('statut', ['termine', 'annule'])
            ->with('patient.user')->latest('updated_at')->take(20)->get();
    
        return view('medecin.rendezvous', compact('enAttente', 'aReprogrammer', 'confirmes', 'historique'));
    }

    public function demandesEnAttente()
    {
        $medecinId = auth()->user()->medecin->id;

        $demandes = RendezVous::where('medecin_id', $medecinId)
            ->where('type', 'immediat')->where('statut', 'en_attente')
            ->where('statut_paiement', 'paye')
            ->with('patient.user')->latest()->get();

        return response()->json($demandes);
    }

    public function accepter(RendezVous $rdv)
    {
        abort_if($rdv->medecin_id !== auth()->user()->medecin->id, 403);

        $rdv->update(['statut' => 'confirme']);

        Notification::create([
            'user_id' => $rdv->patient->user_id,
            'titre' => 'Consultation acceptée',
            'message' => 'Dr. '.auth()->user()->name.' a accepté votre demande. Rejoignez la salle.',
        ]);

        return response()->json(['success' => true]);
    }

    public function refuser(RendezVous $rdv)
    {
        abort_if($rdv->medecin_id !== auth()->user()->medecin->id, 403);
    
        $rdv->update(['statut' => 'a_reprogrammer']);
    
        Notification::create([
            'user_id' => $rdv->patient->user_id,
            'titre' => 'Consultation à reprogrammer',
            'message' => 'Dr. '.auth()->user()->name.' n\'est pas disponible maintenant. Choisissez un nouveau créneau — déjà payé, aucun nouveau paiement requis.',
        ]);
    
        return response()->json(['success' => true]);
    }
    public function destroyHistorique(RendezVous $rdv)
    {
        abort_if($rdv->medecin_id !== auth()->user()->medecin->id, 403);
        abort_unless(in_array($rdv->statut, ['termine', 'annule']), 403);
        $rdv->delete();
        return back()->with('status', 'Entrée supprimée de l\'historique.');
    }
}