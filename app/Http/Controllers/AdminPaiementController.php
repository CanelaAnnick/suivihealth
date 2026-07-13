<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class AdminPaiementController extends Controller
{
    public function index(Request $request)
    {
        $hopitalId = auth()->user()->hopital_id;

        $query = RendezVous::where('statut_paiement', 'paye')
            ->whereHas('medecin', fn ($q) => $q->where('hopital_id', $hopitalId))
            ->with('medecin.user', 'patient.user');

        if ($request->filled('medecin_id')) {
            $query->where('medecin_id', $request->medecin_id);
        }
        if ($request->filled('date_debut')) {
            $query->whereDate('updated_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('updated_at', '<=', $request->date_fin);
        }

        $transactions = $query->latest('updated_at')->get();
        $totalMontant = $transactions->sum('montant');
        $medecins = Medecin::where('hopital_id', $hopitalId)->with('user')->get();

        return view('admin.paiements', compact('transactions', 'totalMontant', 'medecins'));
    }
}