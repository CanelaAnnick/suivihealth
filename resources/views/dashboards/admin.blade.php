@extends('layouts.dashboard')
@section('title', 'Tableau de bord — SuiviHealth')
@section('page-title', 'Tableau de bord')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'accueil'])
@endsection

@section('content')

<div class="bg-gradient-to-br from-navy-900 to-teal-700 rounded-2xl p-6 mb-6 text-white">
    <p class="text-[12.5px] text-white/70">{{ now()->translatedFormat('l d F Y') }}</p>
    <h2 class="text-[20px] font-semibold mt-1">Bonjour, {{ auth()->user()->name }} 👋</h2>
    <p class="text-white/70 text-[13px] mt-1">Gestion des médecins et supervision de la plateforme.</p>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
    <x-stat-tile label="Médecins" :value="$totalMedecins" badge="bg-navy-900/5 text-navy-800"
        icon='<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>' />

    <x-stat-tile label="Médecins actifs" :value="$medecinsActifs" badge="bg-teal-50 text-teal-600"
        icon='<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' />

    <x-stat-tile label="Patients" :value="$totalPatients" badge="bg-sky-50 text-sky-600"
        icon='<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/></svg>' />

    <x-stat-tile label="Rôle" value="Admin" badge="bg-amber-50 text-amber-600"
        icon='<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' />
</div>

<div class="grid md:grid-cols-2 gap-5">
    <x-section-card title="Médecins récemment ajoutés"
        :action="'<a href=\''.route('admin.medecins.index').'\' class=\'text-[12.5px] text-navy-800 font-medium hover:underline\'>Voir tout</a>'">
        @forelse ($derniersMedecins as $m)
            <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold">
                        {{ strtoupper(substr($m->user->name, 4, 2)) }}
                    </div>
                    <div>
                        <p class="text-[13px] font-medium text-slate-900">{{ $m->user->name }}</p>
                        <p class="text-[12px] text-slate-400">{{ $m->specialite }}</p>
                    </div>
                </div>
                <span @class(['text-[11px] font-medium px-2 py-0.5 rounded-full', 'bg-teal-50 text-teal-700' => $m->statut === 'actif', 'bg-red-50 text-red-700' => $m->statut !== 'actif'])>{{ ucfirst($m->statut) }}</span>
            </div>
        @empty
            <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun médecin enregistré.</p></div>
        @endforelse
    </x-section-card>

    <x-section-card title="Actions rapides">
        <a href="{{ route('admin.medecins.index') }}" class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Ajouter un médecin</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
        <a href="{{ route('admin.patients.index') }}" class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Consulter les patients</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
        <a href="{{ route('admin.statistiques') }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Voir les statistiques</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
    </x-section-card>
</div>

@endsection