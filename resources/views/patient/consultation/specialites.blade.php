@extends('layouts.dashboard')
@section('title', 'Spécialités — SuiviHealth')

@section('sidebar')
    <a href="{{ route('patient.dashboard') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Accueil</a>
    <a href="{{ route('patient.consultation.choix') }}" class="block px-3 py-2 rounded-lg bg-navy-800 text-white">Consultation</a>
    <a href="{{ route('patient.dossier.index') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Dossier médical</a>
@endsection

@section('content')
<a href="{{ route('patient.consultation.choix') }}" class="text-sm text-teal-600 hover:underline">← Retour</a>
<h1 class="font-display text-2xl font-semibold text-navy-900 mt-2">Choisissez une spécialité</h1>

<div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8">
    @forelse ($specialites as $specialite)
        <a href="{{ route('patient.consultation.medecins', ['specialite' => $specialite]) }}" class="bg-white rounded-2xl border border-slate-100 p-6 hover:shadow-lg hover:border-coral-500 transition text-center">
            <p class="font-semibold text-navy-900">{{ $specialite }}</p>
        </a>
    @empty
        <p class="text-slate-500 text-sm">Aucune spécialité disponible pour le moment.</p>
    @endforelse
</div>
@endsection