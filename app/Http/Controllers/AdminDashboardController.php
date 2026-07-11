<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalMedecins = Medecin::count();
        $medecinsActifs = Medecin::where('statut', 'actif')->count();
        $totalPatients = Patient::count();
        $derniersMedecins = Medecin::with('user')->latest()->take(5)->get();

        return view('dashboards.admin', compact('totalMedecins', 'medecinsActifs', 'totalPatients', 'derniersMedecins'));
    }
}