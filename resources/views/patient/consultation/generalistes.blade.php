@extends('layouts.dashboard')
@section('title', 'Médecins généralistes — SuiviHealth')
@section('page-title', 'Médecins généralistes')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<a href="{{ route('patient.consultation.choix') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-navy-900 mb-6">
    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour
</a>

<div class="flex items-center gap-3 mb-1">
    <div class="w-10 h-10 rounded-xl bg-teal-600/10 flex items-center justify-center text-teal-600">
        <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    </div>
    <h2 class="font-display text-xl font-semibold text-navy-900">Médecine générale</h2>
</div>
<p class="text-slate-500 text-sm mb-6">Consultation de routine ou premier avis médical.</p>

<form method="GET" action="{{ route('patient.consultation.generalistes') }}" class="flex flex-wrap gap-3 mb-6 bg-white border border-slate-100 rounded-xl p-4">
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

<p class="text-sm text-slate-500 mb-4">{{ $medecins->count() }} médecin(s) disponible(s)</p>

<div class="space-y-4">
    @forelse ($medecins as $medecin)
        <x-doctor-card :medecin="$medecin" label="Médecine générale" />
    @empty
        <p class="text-slate-500 text-sm">Aucun médecin trouvé pour ces critères.</p>
    @endforelse
</div>
@endsection