<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\User;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        $totalHopitaux = Medecin::whereNotNull('hopital')->distinct('hopital')->count('hopital');
        $totalAdmins = User::where('role', 'admin')->count();
        $totalMedecins = Medecin::count();
        $totalPatients = Patient::count();

        return view('dashboards.superadmin', compact('totalHopitaux', 'totalAdmins', 'totalMedecins', 'totalPatients'));
    }
}