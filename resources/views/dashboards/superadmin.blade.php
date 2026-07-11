@extends('layouts.dashboard')
@section('title', 'Tableau de bord — SuiviHealth')
@section('page-title', 'Tableau de bord')

@section('sidebar')
    @include('partials.sidebar-superadmin', ['active' => 'accueil'])
@endsection

@section('content')

<div class="bg-gradient-to-br from-navy-900 to-teal-700 rounded-2xl p-6 mb-6 text-white">
    <p class="text-[12.5px] text-white/70">{{ now()->translatedFormat('l d F Y') }}</p>
    <h2 class="text-[20px] font-semibold mt-1">Bonjour, {{ auth()->user()->name }} 👋</h2>
    <p class="text-white/70 text-[13px] mt-1">Supervision globale de la plateforme SuiviHealth.</p>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
    <x-stat-tile label="Hôpitaux" :value="$totalHopitaux" badge="bg-amber-50 text-amber-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M3.75 21h16.5M4.5 3h15l-.75 18h-13.5L4.5 3zM9 8.25h1.5m3 0H15M9 12h1.5m3 0H15"/></svg>' />

    <x-stat-tile label="Administrateurs" :value="$totalAdmins" badge="bg-navy-900/5 text-navy-800"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' />

    <x-stat-tile label="Médecins" :value="$totalMedecins" badge="bg-teal-50 text-teal-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>' />

    <x-stat-tile label="Patients" :value="$totalPatients" badge="bg-sky-50 text-sky-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/></svg>' />
</div>

<div class="grid md:grid-cols-2 gap-5">
    <x-section-card title="Actions rapides">
        <a href="{{ route('superadmin.hopitaux.index') }}" class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Ajouter un hôpital</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
        <a href="{{ route('superadmin.admins.index') }}" class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Gérer les administrateurs</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
        <a href="{{ route('superadmin.statistiques') }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50 transition">
            <span class="text-[13px] font-medium text-slate-900">Statistiques globales</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
    </x-section-card>

    <x-section-card title="À propos de la plateforme">
        <div class="px-5 py-4">
            <p class="text-[12.5px] text-slate-500 leading-relaxed">
                SuiviHealth connecte patients, médecins et établissements de santé à travers le Cameroun. En tant que super administrateur, vous supervisez l'ensemble des hôpitaux partenaires et des comptes administrateurs.
            </p>
        </div>
    </x-section-card>
</div>

@endsection