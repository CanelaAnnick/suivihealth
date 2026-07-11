@extends('layouts.dashboard')
@section('title', $specialite . ' — SuiviHealth')
@section('page-title', $specialite)

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<a href="{{ route('patient.consultation.specialites') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour aux spécialités
</a>

<form method="GET" action="{{ route('patient.consultation.medecins') }}" class="flex flex-wrap gap-3 mb-5 bg-white border border-slate-200 rounded-xl p-4">
    <div class="flex-1 min-w-[180px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Nom du médecin</label>
        <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher..." class="w-full rounded-lg border-slate-200 text-[12.5px] focus:border-navy-800 focus:ring-navy-800">
    </div>
    <input type="hidden" name="specialite" value="{{ $specialite }}">
    <div class="flex-1 min-w-[150px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Région</label>
        <select name="region" onchange="this.form.submit()" class="w-full rounded-md border-slate-200 text-[12.5px] focus:border-navy-800 focus:ring-navy-800">
            <option value="">Toutes les régions</option>
            @foreach ($regions as $region)
                <option value="{{ $region }}" @selected(request('region') === $region)>{{ $region }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex-1 min-w-[150px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Hôpital</label>
        <select name="hopital" onchange="this.form.submit()" class="w-full rounded-md border-slate-200 text-[12.5px] focus:border-navy-800 focus:ring-navy-800">
            <option value="">Tous les hôpitaux</option>
            @foreach ($hopitaux as $hopital)
                <option value="{{ $hopital }}" @selected(request('hopital') === $hopital)>{{ $hopital }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-end">
        <button type="submit" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Filtrer</button>
    </div>
</form>

<p class="text-[12.5px] text-slate-500 mb-3">{{ $medecins->count() }} médecin(s) trouvé(s)</p>

<div class="space-y-2.5">
    @forelse ($medecins as $medecin)
        <x-doctor-card :medecin="$medecin" label="{{ $specialite }}" />
    @empty
        <p class="text-slate-400 text-[13px]">Aucun médecin trouvé pour ces critères.</p>
    @endforelse
</div>
@endsection