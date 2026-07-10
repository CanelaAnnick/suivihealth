@extends('layouts.dashboard')
@section('title', $specialite . ' — SuiviHealth')
@section('page-title', $specialite)

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<a href="{{ route('patient.consultation.specialites') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-navy-900 mb-6">
    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour aux spécialités
</a>

<h2 class="font-display text-xl font-semibold text-navy-900 mb-6">{{ $specialite }}</h2>

<form method="GET" action="{{ route('patient.consultation.medecins') }}" class="flex flex-wrap gap-3 mb-6 bg-white border border-slate-100 rounded-xl p-4">
    <input type="hidden" name="specialite" value="{{ $specialite }}">
    <div class="flex-1 min-w-[160px]">
        <label class="text-xs font-medium text-slate-500 block mb-1">Région</label>
        <select name="region" onchange="this.form.submit()" class="w-full rounded-lg border-slate-200 text-sm focus:border-teal-600 focus:ring-teal-600">
            <option value="">Toutes les régions</option>
            @foreach ($regions as $region)
                <option value="{{ $region }}" @selected(request('region') === $region)>{{ $region }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 min-w-[160px]">
        <label class="text-xs font-medium text-slate-500 block mb-1">Hôpital</label>
        <select name="hopital" onchange="this.form.submit()" class="w-full rounded-lg border-slate-200 text-sm focus:border-teal-600 focus:ring-teal-600">
            <option value="">Tous les hôpitaux</option>
            @foreach ($hopitaux as $hopital)
                <option value="{{ $hopital }}" @selected(request('hopital') === $hopital)>{{ $hopital }}</option>
            @endforeach
        </select>
    </div>
</form>

<p class="text-sm text-slate-500 mb-4">{{ $medecins->count() }} médecin(s) trouvé(s)</p>

<div class="space-y-4">
    @forelse ($medecins as $medecin)
        <x-doctor-card :medecin="$medecin" label="{{ $specialite }}" />
    @empty
        <p class="text-slate-500 text-sm">Aucun médecin trouvé pour ces critères.</p>
    @endforelse
</div>
@endsection