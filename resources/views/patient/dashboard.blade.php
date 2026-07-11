@extends('layouts.dashboard')
@section('title', 'Tableau de bord — SuiviHealth')
@section('page-title', 'Tableau de bord')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'accueil'])
@endsection

@section('content')

@php
    $symptomesCount = auth()->user()->patient->symptomes()->count();
    $rdvCount = auth()->user()->patient->rendezVous()->where('statut', 'confirme')->count();
    $ordonnancesCount = auth()->user()->patient->ordonnances()->count();
@endphp

<div class="bg-gradient-to-br from-navy-900 to-teal-700 rounded-2xl p-6 mb-6 text-white">
    <p class="text-[12.5px] text-white/70">{{ now()->translatedFormat('l d F Y') }}</p>
    <h2 class="text-[20px] font-semibold mt-1">{{ now()->format('H') < 18 ? 'Bonjour' : 'Bonsoir' }}, {{ explode(' ', auth()->user()->name)[0] }} 👋</h2>
    <p class="text-white/70 text-[13px] mt-1">Comment vous sentez-vous aujourd'hui ?</p>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
    <x-stat-tile label="Symptômes" :value="$symptomesCount" badge="bg-coral-50 text-coral-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>' />

    <x-stat-tile label="Rendez-vous" :value="$rdvCount" badge="bg-teal-50 text-teal-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>' />

    <x-stat-tile label="Ordonnances" :value="$ordonnancesCount" badge="bg-navy-900/5 text-navy-800"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' />

    <x-stat-tile label="Statut du dossier" value="À jour" badge="bg-sky-50 text-sky-600"
        icon='<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' />
</div>

<div class="grid md:grid-cols-3 gap-3.5 mb-6">
    <a href="{{ route('patient.consultation.choix') }}" class="bg-white border border-slate-200 rounded-2xl p-5 hover:border-teal-300 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center mb-3.5 text-teal-600">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        </div>
        <h3 class="text-[14px] font-semibold text-slate-900 mb-0.5">Prendre une consultation</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Généraliste ou spécialiste, en ligne ou en présentiel.</p>
    </a>

    <a href="{{ route('patient.dossier.index') }}" class="bg-white border border-slate-200 rounded-2xl p-5 hover:border-coral-300 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-xl bg-coral-50 flex items-center justify-center mb-3.5 text-coral-600">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
        </div>
        <h3 class="text-[14px] font-semibold text-slate-900 mb-0.5">Dossier médical</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Ajoutez vos symptômes, visibles par votre médecin.</p>
    </a>

    <a href="{{ route('patient.constantes.index') }}" class="bg-white border border-slate-200 rounded-2xl p-5 hover:border-navy-300 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-xl bg-navy-900/5 flex items-center justify-center mb-3.5 text-navy-800">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M3.75 12h3l2.25-7.5L13.5 19.5l2.25-7.5h4.5"/></svg>
        </div>
        <h3 class="text-[14px] font-semibold text-slate-900 mb-0.5">Mes constantes</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Suivez tension, poids, glycémie dans le temps.</p>
    </a>
</div>

@php
    $recents = auth()->user()->patient->symptomes()->latest()->take(4)->get();
@endphp

<x-section-card title="Derniers symptômes signalés"
    :action="'<a href=\''.route('patient.dossier.index').'\' class=\'text-[12.5px] text-navy-800 font-medium hover:underline\'>Voir tout</a>'">
    @forelse ($recents as $s)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center gap-3 min-w-0">
                <span @class([
                    'w-2 h-2 rounded-full shrink-0',
                    'bg-teal-500' => $s->gravite === 'legere',
                    'bg-amber-500' => $s->gravite === 'moderee',
                    'bg-red-500' => $s->gravite === 'severe',
                ])></span>
                <div class="min-w-0">
                    <p class="text-[13px] font-medium text-slate-900 truncate">{{ $s->titre }}</p>
                    <p class="text-slate-400 text-[12px] mt-0.5">{{ $s->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <span @class([
                'text-[11px] font-medium px-2 py-0.5 rounded-full shrink-0 ml-3',
                'bg-teal-50 text-teal-700' => $s->gravite === 'legere',
                'bg-amber-50 text-amber-700' => $s->gravite === 'moderee',
                'bg-red-50 text-red-700' => $s->gravite === 'severe',
            ])>{{ ucfirst($s->gravite) }}</span>
        </div>
    @empty
        <div class="px-5 py-10 text-center">
            <p class="text-[13px] text-slate-400">Aucun symptôme enregistré pour le moment.</p>
        </div>
    @endforelse
</x-section-card>

@endsection