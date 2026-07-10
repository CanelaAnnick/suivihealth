<?php

namespace App\Http\Controllers;

class PatientDashboardController extends Controller
{
    public function index()
    {
        return view('patient.dashboard');
    }
}