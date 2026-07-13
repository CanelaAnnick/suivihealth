<?php

namespace App\Http\Controllers;

use App\Models\Hopital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->with('hopital')->latest()->get();

        return view('superadmin.admins', compact('admins'));
    }

    public function create()
    {
        $hopitaux = Hopital::all();

        return view('superadmin.admin-create', compact('hopitaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'hopital_id' => 'required|exists:hopitaux,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'hopital_id' => $request->hopital_id,
        ]);

        return redirect()->route('superadmin.admins.index')->with('status', 'Administrateur ajouté. Identifiants : '.$request->email);
    }

    public function toggleActif(User $admin)
    {
        abort_unless($admin->role === 'admin', 403);
        $admin->update(['actif' => ! $admin->actif]);

        return back()->with('status', 'Statut mis à jour.');
    }

    public function destroy(User $admin)
    {
        abort_unless($admin->role === 'admin', 403);
        $admin->delete();

        return redirect()->route('superadmin.admins.index')->with('status', 'Administrateur supprimé.');
    }
}