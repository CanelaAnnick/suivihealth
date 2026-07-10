@extends('layouts.dashboard')
@section('title', $specialite . ' — SuiviHealth')

@section('sidebar')
    <a href="{{ route('patient.dashboard') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Accueil</a>
    <a href="{{ route('patient.consultation.choix') }}" class="block px-3 py-2 rounded-lg bg-navy-800 text-white">Consultation</a>
    <a href="{{ route('patient.dossier.index') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Dossier médical</a>
@endsection

@section('content')
<a href="{{ route('patient.consultation.specialites') }}" class="text-sm text-teal-600 hover:underline">← Retour aux spécialités</a>
<h1 class="font-display text-2xl font-semibold text-navy-900 mt-2">{{ $specialite }}</h1>

<form method="GET" action="{{ route('patient.consultation.medecins') }}" class="flex flex-wrap gap-4 mt-6">
    <input type="hidden" name="specialite" value="{{ $specialite }}">
    <div>
        <label class="text-xs font-medium text-slate-500 block mb-1">Région</label>
        <select name="region" onchange="this.form.submit()" class="rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600 text-sm">
            <option value="">Toutes les régions</option>
            @foreach ($regions as $region)
                <option value="{{ $region }}" @selected(request('region') === $region)>{{ $region }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-xs font-medium text-slate-500 block mb-1">Hôpital</label>
        <select name="hopital" onchange="this.form.submit()" class="rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600 text-sm">
            <option value="">Tous les hôpitaux</option>
            @foreach ($hopitaux as $hopital)
                <option value="{{ $hopital }}" @selected(request('hopital') === $hopital)>{{ $hopital }}</option>
            @endforeach
        </select>
    </div>
</form>

<p class="text-slate-600 text-sm mt-6">{{ $medecins->count() }} médecin(s) trouvé(s)</p>

<div class="grid md:grid-cols-3 gap-6 mt-4">
    @forelse ($medecins as $medecin)
        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            <div class="w-12 h-12 rounded-full bg-navy-900 text-white flex items-center justify-center font-semibold mb-4">
                {{ strtoupper(substr($medecin->user->name, 0, 2)) }}
            </div>
            <h3 class="font-semibold text-navy-900">{{ $medecin->user->name }}</h3>
            <p class="text-sm text-slate-500 mb-1">{{ $specialite }}</p>
            <p class="text-xs text-slate-400 mb-4">{{ $medecin->hopital ?? 'Non renseigné' }} · {{ $medecin->region }}</p>
            <button class="w-full bg-navy-900 text-white text-sm font-semibold py-2 rounded-lg hover:bg-navy-800 transition">Prendre rendez-vous</button>
        </div>
    @empty
        <p class="text-slate-500 text-sm col-span-3">Aucun médecin trouvé pour ces critères.</p>
    @endforelse
</div>
@endsection