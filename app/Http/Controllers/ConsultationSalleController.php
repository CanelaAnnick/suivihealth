<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use Illuminate\Http\Request;

class ConsultationSalleController extends Controller
{
    protected function autoriser(RendezVous $rdv)
    {
        $user = auth()->user();

        $estLePatient = $user->role === 'patient' && $rdv->patient_id === $user->patient->id;
        $estLeMedecin = $user->role === 'medecin' && $rdv->medecin_id === $user->medecin->id;

        abort_unless($estLePatient || $estLeMedecin, 403);
    }

    public function show(RendezVous $rdv)
    {
        $this->autoriser($rdv);

        $rdv->load('patient.user', 'medecin.user');

        return view('salle.show', compact('rdv'));
    }

    public function getMessages(RendezVous $rdv)
    {
        $this->autoriser($rdv);

        return response()->json(
            $rdv->messages()->with('sender')->orderBy('created_at')->get()
        );
    }

    public function storeMessage(Request $request, RendezVous $rdv)
    {
        $this->autoriser($rdv);

        $request->validate(['contenu' => 'required|string|max:2000']);

        $message = $rdv->messages()->create([
            'sender_id' => auth()->id(),
            'contenu' => $request->contenu,
        ]);

        return response()->json($message->load('sender'));
    }

    public function statut(RendezVous $rdv)
    {
        $this->autoriser($rdv);

        return response()->json(['statut' => $rdv->statut]);
    }
    public function terminer(RendezVous $rdv)
    {
        $this->autoriser($rdv);
    
        $rdv->update(['statut' => 'termine']);
    
        $autreUserId = auth()->user()->role === 'patient' ? $rdv->medecin->user_id : $rdv->patient->user_id;
    
        \App\Models\Notification::create([
            'user_id' => $autreUserId,
            'titre' => 'Consultation terminée',
            'message' => 'La consultation a été clôturée.',
        ]);
    
        return response()->json(['success' => true]);
    }
}