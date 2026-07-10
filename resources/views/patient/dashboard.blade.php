@extends('layouts.dashboard')
@section('title', 'Tableau de bord — SuiviHealth')
@section('page-title', 'Tableau de bord')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'accueil'])
@endsection

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-[12.5px] text-slate-400">{{ now()->translatedFormat('l d F Y') }}</p>
        <h2 class="text-[19px] font-semibold text-slate-900 mt-0.5">
            {{ now()->format('H') < 18 ? 'Bonjour' : 'Bonsoir' }}, {{ explode(' ', auth()->user()->name)[0] }}
        </h2>
    </div>
    <a href="{{ route('patient.consultation.choix') }}" class="hidden sm:inline-flex items-center gap-1.5 bg-navy-900 text-white text-[13px] font-medium px-3.5 py-2 rounded-md hover:bg-navy-800 transition">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 1v12M1 7h12"/></svg>
        Nouvelle consultation
    </a>
</div>

@php
    $symptomesCount = auth()->user()->patient->symptomes()->count();
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
    <div class="bg-white border border-slate-200 rounded-lg p-4">
        <p class="text-[12px] text-slate-400 font-medium">Symptômes signalés</p>
        <p class="text-[22px] font-semibold text-slate-900 mt-1">{{ $symptomesCount }}</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-lg p-4">
        <p class="text-[12px] text-slate-400 font-medium">Rendez-vous</p>
        <p class="text-[22px] font-semibold text-slate-900 mt-1">0</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-lg p-4 col-span-2 md:col-span-1">
        <p class="text-[12px] text-slate-400 font-medium">Consultations passées</p>
        <p class="text-[22px] font-semibold text-slate-900 mt-1">0</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-lg p-4 col-span-2 md:col-span-1">
        <p class="text-[12px] text-slate-400 font-medium">Statut du dossier</p>
        <p class="text-[13px] font-medium text-teal-700 mt-2 inline-flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-teal-600"></span> À jour
        </p>
    </div>
</div>

<div class="grid md:grid-cols-3 gap-3 mb-8">
    <a href="{{ route('patient.consultation.choix') }}" class="group bg-white border border-slate-200 rounded-lg p-5 hover:border-slate-300 hover:shadow-sm transition">
        <div class="w-8 h-8 rounded-md border border-slate-200 flex items-center justify-center mb-3 text-slate-600">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        </div>
        <h3 class="text-[13.5px] font-semibold text-slate-900 mb-0.5">Prendre une consultation</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Généraliste ou spécialiste, en ligne ou en présentiel.</p>
    </a>

    <a href="{{ route('patient.dossier.index') }}" class="group bg-white border border-slate-200 rounded-lg p-5 hover:border-slate-300 hover:shadow-sm transition">
        <div class="w-8 h-8 rounded-md border border-slate-200 flex items-center justify-center mb-3 text-slate-600">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
        </div>
        <h3 class="text-[13.5px] font-semibold text-slate-900 mb-0.5">Dossier médical</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Ajoutez vos symptômes, visibles par votre médecin.</p>
    </a>

    <div class="bg-white border border-slate-200 rounded-lg p-5">
        <div class="w-8 h-8 rounded-md border border-slate-200 flex items-center justify-center mb-3 text-slate-600">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12"/></svg>
        </div>
        <h3 class="text-[13.5px] font-semibold text-slate-900 mb-0.5">Prochain rendez-vous</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Aucun rendez-vous prévu pour le moment.</p>
    </div>
</div>

@php
    $recents = auth()->user()->patient->symptomes()->latest()->take(4)->get();
@endphp

<div>
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-[13.5px] font-semibold text-slate-900">Derniers symptômes signalés</h3>
        <a href="{{ route('patient.dossier.index') }}" class="text-[12.5px] text-navy-900 font-medium hover:underline">Voir tout</a>
    </div>

    <div class="bg-white border border-slate-200 rounded-lg overflow-hidden">
        @forelse ($recents as $s)
            <div class="flex items-center justify-between px-4 py-3 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <div class="min-w-0">
                    <p class="text-[13px] font-medium text-slate-900 truncate">{{ $s->titre }}</p>
                    <p class="text-slate-400 text-[12px] mt-0.5">{{ $s->created_at->diffForHumans() }}</p>
                </div>
                <span @class([
                    'text-[11px] font-medium px-2 py-0.5 rounded shrink-0 ml-3',
                    'bg-teal-50 text-teal-700' => $s->gravite === 'legere',
                    'bg-amber-50 text-amber-700' => $s->gravite === 'moderee',
                    'bg-red-50 text-red-700' => $s->gravite === 'severe',
                ])>{{ ucfirst($s->gravite) }}</span>
            </div>
        @empty
            <div class="px-4 py-8 text-center">
                <p class="text-[13px] text-slate-400">Aucun symptôme enregistré pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection