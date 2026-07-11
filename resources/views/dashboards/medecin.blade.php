@extends('layouts.dashboard')
@section('title', 'Tableau de bord — SuiviHealth')
@section('page-title', 'Tableau de bord')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'accueil'])
@endsection

@section('content')

<div class="bg-gradient-to-br from-navy-900 to-teal-700 rounded-2xl p-6 mb-6 text-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
    x-data="{ dispo: {{ auth()->user()->medecin->disponible_immediat ? 'true' : 'false' }}, loading: false }">
    <div>
        <p class="text-[12.5px] text-white/70">{{ now()->translatedFormat('l d F Y') }}</p>
        <h2 class="text-[20px] font-semibold mt-1">Bonjour, {{ auth()->user()->name }} 👋</h2>
        <p class="text-white/70 text-[13px] mt-1">{{ auth()->user()->medecin->specialite }} · {{ auth()->user()->medecin->hopital ?? 'Cabinet indépendant' }}</p>
    </div>

    <button type="button" :disabled="loading"
        @click="loading = true; fetch('{{ route('medecin.disponibilite.toggle') }}', { method: 'PATCH', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(r => r.json()).then(d => { dispo = d.disponible; loading = false })"
        class="flex items-center gap-3 bg-white/10 hover:bg-white/15 transition rounded-xl px-4 py-3 shrink-0">
        <span class="w-2.5 h-2.5 rounded-full" :class="dispo ? 'bg-teal-400' : 'bg-slate-400'"></span>
        <div class="text-left">
            <p class="text-[12.5px] font-medium" x-text="dispo ? 'Disponible pour consultation immédiate' : 'Indisponible actuellement'"></p>
            <p class="text-[11px] text-white/60">Cliquez pour changer</p>
        </div>
    </button>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
    <x-stat-tile label="Aujourd'hui" :value="$rdvAujourdhui" sub="Rendez-vous" badge="bg-teal-50 text-teal-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>' />

    <x-stat-tile label="En attente" :value="$rdvEnAttente" sub="À confirmer" badge="bg-amber-50 text-amber-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>' />

    <x-stat-tile label="Patients suivis" :value="$totalPatients" badge="bg-sky-50 text-sky-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/></svg>' />

    <x-stat-tile label="Statut" value="Actif" badge="bg-teal-50 text-teal-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' />
</div>

<div class="grid md:grid-cols-2 gap-5">
    <x-section-card title="Prochains rendez-vous">
        @forelse ($prochainsRdv as $rdv)
            <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $rdv->patient->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }} · {{ ucfirst($rdv->mode) }}</p>
                </div>
                <span class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-teal-50 text-teal-700">Confirmé</span>
            </div>
        @empty
            <div class="px-5 py-10 text-center">
                <p class="text-[13px] text-slate-400">Aucun rendez-vous à venir.</p>
            </div>
        @endforelse
    </x-section-card>

    <x-section-card title="Accès rapide">
        <a href="{{ route('medecin.patients') }}" class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Consulter mes patients</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
        <a href="{{ route('medecin.rendezvous') }}" class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Gérer mes rendez-vous</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
        <a href="{{ route('medecin.ordonnances') }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Rédiger une ordonnance</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
    </x-section-card>
</div>

@endsection