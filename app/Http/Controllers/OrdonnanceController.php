<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdonnanceController extends Controller
{
    public function index()
    {
        $ordonnances = auth()->user()->patient->ordonnances()->with('medecin.user')->latest('date_prescription')->get();

        return view('patient.ordonnances', compact('ordonnances'));
    }

    public function telecharger(Ordonnance $ordonnance)
    {
        abort_if($ordonnance->patient_id !== auth()->user()->patient->id, 403);

        $pdf = Pdf::loadView('pdf.ordonnance', compact('ordonnance'));

        return $pdf->download('ordonnance-'.$ordonnance->date_prescription->format('d-m-Y').'.pdf');
    }
}