@extends('layouts.dashboard')
@section('title', 'Médecins généralistes — SuiviHealth')

@section('sidebar')
    <a href="{{ route('patient.dashboard') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Accueil</a>
    <a href="{{ route('patient.consultation.choix') }}" class="block px-3 py-2 rounded-lg bg-navy-800 text-white">Consultation</a>
    <a href="{{ route('patient.dossier.index') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Dossier médical</a>
@endsection

@section('content')
<a href="{{ route('patient.consultation.choix') }}" class="text-sm text-teal-600 hover:underline">← Retour</a>
<h1 class="font-display text-2xl font-semibold text-navy-900 mt-2">Médecins généralistes</h1>
<p class="text-slate-600 mt-1">{{ $medecins->count() }} médecin(s) disponible(s)</p>

<div class="grid md:grid-cols-3 gap-6 mt-8">
    @forelse ($medecins as $medecin)
        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            <div class="w-12 h-12 rounded-full bg-navy-900 text-white flex items-center justify-center font-semibold mb-4">
                {{ strtoupper(substr($medecin->user->name, 0, 2)) }}
            </div>
            <h3 class="font-semibold text-navy-900">{{ $medecin->user->name }}</h3>
            <p class="text-sm text-slate-500 mb-1">Médecine générale</p>
            <p class="text-xs text-slate-400 mb-4">{{ $medecin->hopital ?? 'Cabinet indépendant' }} · {{ $medecin->region }}</p>
            <button class="w-full bg-navy-900 text-white text-sm font-semibold py-2 rounded-lg hover:bg-navy-800 transition">Prendre rendez-vous</button>
        </div>
    @empty
        <p class="text-slate-500 text-sm">Aucun médecin généraliste disponible pour le moment.</p>
    @endforelse
</div>
@endsection