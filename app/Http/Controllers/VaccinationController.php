<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom_vaccin' => 'required|string|max:255',
            'date_administration' => 'required|date',
            'date_rappel' => 'nullable|date',
        ]);

        auth()->user()->patient->vaccinations()->create($request->only('nom_vaccin', 'date_administration', 'date_rappel'));

        return back()->with('status', 'Vaccin ajouté.');
    }

    public function destroy(Vaccination $vaccination)
    {
        abort_if($vaccination->patient_id !== auth()->user()->patient->id, 403);
        $vaccination->delete();
        return back()->with('status', 'Vaccin supprimé.');
    }
}