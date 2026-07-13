<?php

namespace App\Http\Controllers;

use App\Models\Hopital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminHopitalController extends Controller
{
    protected array $regions = [
        'Adamaoua', 'Centre', 'Est', 'Extrême-Nord', 'Littoral',
        'Nord', 'Nord-Ouest', 'Ouest', 'Sud', 'Sud-Ouest',
    ];

    public function index()
    {
        $hopitaux = Hopital::withCount('medecins')->with('admins')->get();

        return view('superadmin.hopitaux', compact('hopitaux'));
    }

    public function create()
    {
        return view('superadmin.hopital-create', ['regions' => $this->regions]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'region' => 'required|string',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8',
        ]);

        $hopital = \App\Models\Hopital::create($request->only('nom', 'region', 'adresse', 'telephone'));

        User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => 'admin',
            'hopital_id' => $hopital->id,
        ]);

        return redirect()->route('superadmin.hopitaux.index')->with('status', 'Hôpital créé. Identifiants admin : '.$request->admin_email.' — communiquez le mot de passe choisi.');
    }
}