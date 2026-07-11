<?php

namespace App\Http\Controllers;

use App\Models\Medecin;

class UrgenceController extends Controller
{
    public function index()
    {
        $hopitaux = Medecin::whereNotNull('hopital')->select('hopital', 'region')->distinct()->get();

        return view('patient.urgence', compact('hopitaux'));
    }
}