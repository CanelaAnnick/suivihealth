@extends('layouts.dashboard')
@section('title', 'Mes patients — SuiviHealth')
@section('page-title', 'Mes patients')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'patients'])
@endsection

@section('content')

<form method="GET" action="{{ route('medecin.patients') }}" class="flex flex-wrap gap-3 mb-5 bg-white border border-slate-200 rounded-xl p-4">
    <div class="flex-1 min-w-[200px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Rechercher un patient</label>
        <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Nom du patient..." class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
    </div>
    <div class="min-w-[160px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Trier par</label>
        <select name="tri" onchange="this.form.submit()" class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            <option value="nom" @selected(request('tri', 'nom') === 'nom')>Nom (A-Z)</option>
            <option value="recent" @selected(request('tri') === 'recent')>Consultation la plus récente</option>
        </select>
    </div>
    <div class="flex items-end">
        <button type="submit" class="bg-navy-900 text-white text-[13px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Filtrer</button>
    </div>
</form>

<x-section-card title="Patients suivis ({{ $patients->count() }})">
    @forelse ($patients as $patient)
        <a href="{{ route('medecin.patients.show', $patient) }}" class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }} hover:bg-slate-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($patient->user->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $patient->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">
                        {{ $patient->derniere_consultation ? 'Dernière consultation : '.$patient->derniere_consultation->format('d/m/Y') : 'Aucune consultation récente' }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <span class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-coral-50 text-coral-700">{{ $patient->symptomes_count }} symptôme(s)</span>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
            </div>
        </a>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun patient trouvé.</p></div>
    @endforelse
</x-section-card>
@endsection