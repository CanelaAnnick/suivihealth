<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function choixMode(Medecin $medecin)
    {
        return view('patient.consultation.mode-choice', compact('medecin'));
    }

    public function consulterMaintenant(Request $request, Medecin $medecin)
    {
        $request->validate(['mode' => 'required|in:chat,audio,video']);

        $rdv = RendezVous::create([
            'patient_id' => auth()->user()->patient->id,
            'medecin_id' => $medecin->id,
            'mode' => $request->mode,
            'type' => 'immediat',
            'montant' => $medecin->tarif,
        ]);

        return redirect()->route('patient.consultation.paiement', $rdv);
    }

    public function formulaireRdv(Medecin $medecin)
    {
        return view('patient.consultation.programmer', compact('medecin'));
    }

    public function storeRdv(Request $request, Medecin $medecin)
    {
        $request->validate([
            'mode' => 'required|in:chat,audio,video',
            'date_rdv' => 'required|date|after_or_equal:today',
            'heure_rdv' => 'required',
        ]);

        $rdv = RendezVous::create([
            'patient_id' => auth()->user()->patient->id,
            'medecin_id' => $medecin->id,
            'mode' => $request->mode,
            'type' => 'programme',
            'date_rdv' => $request->date_rdv,
            'heure_rdv' => $request->heure_rdv,
            'montant' => $medecin->tarif,
        ]);

        return redirect()->route('patient.consultation.paiement', $rdv);
    }

    public function paiement(RendezVous $rdv)
    {
        abort_if($rdv->patient_id !== auth()->user()->patient->id, 403);

        return view('patient.consultation.paiement', compact('rdv'));
    }

    public function confirmerPaiement(Request $request, RendezVous $rdv)
    {
        abort_if($rdv->patient_id !== auth()->user()->patient->id, 403);

        $request->validate(['moyen_paiement' => 'required|in:orange_money,mtn_momo,carte']);

        // Simulation : ici viendra l'appel réel à l'API Orange Money / MTN MoMo / passerelle carte
        $rdv->update([
            'moyen_paiement' => $request->moyen_paiement,
            'statut_paiement' => 'paye',
            'statut' => 'confirme',
        ]);

        return redirect()->route('patient.consultation.confirmation', $rdv);
    }

    public function confirmation(RendezVous $rdv)
    {
        abort_if($rdv->patient_id !== auth()->user()->patient->id, 403);

        return view('patient.consultation.confirmation', compact('rdv'));
    }

    public function apiCreerConsultation(Request $request, Medecin $medecin)
    {
        $request->validate(['mode' => 'required|in:chat,audio,video']);

        $rdv = RendezVous::create([
            'patient_id' => auth()->user()->patient->id,
            'medecin_id' => $medecin->id,
            'mode' => $request->mode,
            'type' => 'immediat',
            'montant' => $medecin->tarif,
        ]);

        return response()->json(['id' => $rdv->id, 'montant' => $rdv->montant]);
    }

    public function apiCreerRdv(Request $request, Medecin $medecin)
    {
        $request->validate([
            'mode' => 'required|in:chat,audio,video',
            'date_rdv' => 'required|date|after_or_equal:today',
            'heure_rdv' => 'required',
        ]);

        $rdv = RendezVous::create([
            'patient_id' => auth()->user()->patient->id,
            'medecin_id' => $medecin->id,
            'mode' => $request->mode,
            'type' => 'programme',
            'date_rdv' => $request->date_rdv,
            'heure_rdv' => $request->heure_rdv,
            'montant' => $medecin->tarif,
        ]);

        return response()->json(['id' => $rdv->id, 'montant' => $rdv->montant]);
    }

    public function apiPayer(Request $request, RendezVous $rdv)
    {
        abort_if($rdv->patient_id !== auth()->user()->patient->id, 403);
    
        $request->validate(['moyen_paiement' => 'required|in:orange_money,mtn_momo,carte']);
    
        // Immédiat : paiement OK, mais on attend l'acceptation du médecin.
        // Programmé : confirmé directement, le médecin verra le RDV dans son planning.
        $rdv->update([
            'moyen_paiement' => $request->moyen_paiement,
            'statut_paiement' => 'paye',
            'statut' => $rdv->type === 'immediat' ? 'en_attente' : 'confirme',
        ]);
    
        try {
            \App\Models\Notification::create([
                'user_id' => $rdv->medecin->user_id,
                'titre' => $rdv->type === 'immediat' ? 'Nouvelle demande de consultation' : 'Nouveau rendez-vous',
                'message' => $rdv->patient->user->name.' souhaite une consultation '.$rdv->mode.'.',
            ]);
        } catch (\Throwable $e) {
            \Log::warning('Notification non créée : '.$e->getMessage());
        }
    
        return response()->json(['success' => true]);
    }
    public function reprogrammer(RendezVous $rdv)
    {
        abort_if($rdv->patient_id !== auth()->user()->patient->id, 403);
        abort_unless($rdv->statut === 'a_reprogrammer', 404);
    
        return view('patient.consultation.reprogrammer', compact('rdv'));
    }

    public function storeReprogrammation(Request $request, RendezVous $rdv)
    {
        abort_if($rdv->patient_id !== auth()->user()->patient->id, 403);
        abort_unless($rdv->statut === 'a_reprogrammer', 404);

        $request->validate([
            'date_rdv' => 'required|date|after_or_equal:today',
            'heure_rdv' => 'required',
        ]);

        $rdv->update([
            'date_rdv' => $request->date_rdv,
            'heure_rdv' => $request->heure_rdv,
            'type' => 'programme',
            'statut' => 'confirme',
        ]);

        \App\Models\Notification::create([
            'user_id' => $rdv->medecin->user_id,
            'titre' => 'Rendez-vous reprogrammé',
            'message' => $rdv->patient->user->name.' a choisi un nouveau créneau.',
        ]);

        return redirect()->route('patient.dashboard')->with('status', 'Rendez-vous reprogrammé avec succès.');
    }
}