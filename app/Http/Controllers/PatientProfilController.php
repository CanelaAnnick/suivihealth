<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientProfilController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'date_naissance' => 'nullable|date',
            'sexe' => 'nullable|in:M,F',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'groupe_sanguin' => 'nullable|string|max:5',
        ]);

        auth()->user()->patient->update($request->only(
            'date_naissance', 'sexe', 'telephone', 'adresse', 'groupe_sanguin'
        ));

        return back()->with('status', 'Informations mises à jour.');
    }
}