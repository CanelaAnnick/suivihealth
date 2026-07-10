<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    protected array $regions = [
        'Adamaoua', 'Centre', 'Est', 'Extrême-Nord', 'Littoral',
        'Nord', 'Nord-Ouest', 'Ouest', 'Sud', 'Sud-Ouest',
    ];

    public function choix()
    {
        return view('patient.consultation.choix');
    }

    public function generalistes()
    {
        $medecins = Medecin::with('user')
            ->where('type', 'generaliste')
            ->where('statut', 'actif')
            ->get();

        return view('patient.consultation.generalistes', compact('medecins'));
    }

    public function specialites()
    {
        $specialites = Medecin::where('type', 'specialiste')
            ->where('statut', 'actif')
            ->distinct()
            ->pluck('specialite');

        return view('patient.consultation.specialites', compact('specialites'));
    }

    public function medecinsParSpecialite(Request $request)
    {
        $specialite = $request->query('specialite');

        $query = Medecin::with('user')
            ->where('type', 'specialiste')
            ->where('specialite', $specialite)
            ->where('statut', 'actif');

        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }
        if ($request->filled('hopital')) {
            $query->where('hopital', $request->hopital);
        }

        $medecins = $query->get();

        $hopitaux = Medecin::where('type', 'specialiste')
            ->where('specialite', $specialite)
            ->distinct()
            ->pluck('hopital')
            ->filter();

        return view('patient.consultation.medecins', [
            'medecins' => $medecins,
            'specialite' => $specialite,
            'regions' => $this->regions,
            'hopitaux' => $hopitaux,
        ]);
    }
}