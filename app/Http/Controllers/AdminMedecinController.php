<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminMedecinController extends Controller
{
    protected array $regions = [
        'Adamaoua', 'Centre', 'Est', 'Extrême-Nord', 'Littoral',
        'Nord', 'Nord-Ouest', 'Ouest', 'Sud', 'Sud-Ouest',
    ];

    public function index(Request $request)
    {
        $query = Medecin::with('user');

        if ($request->filled('recherche')) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$request->recherche.'%'));
        }

        $medecins = $query->latest()->get();

        return view('admin.medecins', compact('medecins'));
    }

    public function create()
    {
        return view('admin.medecin-create', ['regions' => $this->regions]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'specialite' => 'required|string',
            'type' => 'required|in:generaliste,specialiste',
            'region' => 'required|string',
            'hopital' => 'nullable|string',
            'numero_ordre' => 'required|string|unique:medecins,numero_ordre',
            'telephone' => 'nullable|string',
            'tarif' => 'required|integer|min:0',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'medecin',
        ]);

        Medecin::create([
            'user_id' => $user->id,
            'specialite' => $request->specialite,
            'type' => $request->type,
            'region' => $request->region,
            'hopital' => $request->hopital,
            'numero_ordre' => $request->numero_ordre,
            'telephone' => $request->telephone,
            'tarif' => $request->tarif,
            'statut' => 'actif',
        ]);

        return redirect()->route('admin.medecins.index')->with('status', 'Médecin ajouté. Identifiants : '.$request->email.' — communiquez le mot de passe choisi au médecin.');
    }

    public function toggleStatut(Medecin $medecin)
    {
        $medecin->update(['statut' => $medecin->statut === 'actif' ? 'inactif' : 'actif']);

        return back()->with('status', 'Statut mis à jour.');
    }
}