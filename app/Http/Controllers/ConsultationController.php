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
        $prixGeneraliste = Medecin::where('type', 'generaliste')->where('statut', 'actif')->min('tarif');
        $prixSpecialiste = Medecin::where('type', 'specialiste')->where('statut', 'actif')->min('tarif');
    
        return view('patient.consultation.choix', compact('prixGeneraliste', 'prixSpecialiste'));
    }

    public function generalistes(Request $request)
    {
        $query = Medecin::with('user')->where('type', 'generaliste')->where('statut', 'actif');
    
        if ($request->filled('region')) $query->where('region', $request->region);
        if ($request->filled('hopital')) $query->where('hopital', $request->hopital);
        if ($request->filled('recherche')) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$request->recherche.'%'));
        }
    
        $medecins = $query->get();
        $hopitaux = Medecin::where('type', 'generaliste')->distinct()->pluck('hopital')->filter();
    
        return view('patient.consultation.generalistes', [
            'medecins' => $medecins, 'regions' => $this->regions, 'hopitaux' => $hopitaux,
        ]);
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
    
        $query = Medecin::with('user')->where('type', 'specialiste')->where('specialite', $specialite)->where('statut', 'actif');
    
        if ($request->filled('region')) $query->where('region', $request->region);
        if ($request->filled('hopital')) $query->where('hopital', $request->hopital);
        if ($request->filled('recherche')) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$request->recherche.'%'));
        }
    
        $medecins = $query->get();
        $hopitaux = Medecin::where('type', 'specialiste')->where('specialite', $specialite)->distinct()->pluck('hopital')->filter();
    
        return view('patient.consultation.medecins', [
            'medecins' => $medecins, 'specialite' => $specialite, 'regions' => $this->regions, 'hopitaux' => $hopitaux,
        ]);
    }
}