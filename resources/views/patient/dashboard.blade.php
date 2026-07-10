@extends('layouts.dashboard')
@section('title', 'Tableau de bord — SuiviHealth')
@section('page-title', 'Accueil')

@php
    $icon = fn($path) => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">'.$path.'</svg>';
@endphp

@section('sidebar')
    <x-nav-item :route="route('patient.dashboard')" :active="true" :icon="$icon('<path d=\'M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25\'/>')">
        Accueil
    </x-nav-item>
    <x-nav-item :route="route('patient.consultation.choix')" :icon="$icon('<path d=\'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5\'/>')">
        Consultation
    </x-nav-item>
    <x-nav-item :route="route('patient.dossier.index')" :icon="$icon('<path d=\'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z\'/>')">
        Dossier médical
    </x-nav-item>
@endsection

@section('content')

<div class="mb-8">
    <p class="text-slate-500 text-sm">{{ now()->translatedFormat('l d F Y') }}</p>
    <h2 class="font-display text-2xl font-semibold text-navy-900 mt-1">
        {{ now()->format('H') < 18 ? 'Bonjour' : 'Bonsoir' }}, {{ explode(' ', auth()->user()->name)[0] }}
    </h2>
</div>

<div class="grid md:grid-cols-3 gap-5">

    <a href="{{ route('patient.consultation.choix') }}" class="group bg-white rounded-2xl border border-slate-100 p-6 hover:border-teal-600/30 hover:shadow-sm transition">
        <div class="w-10 h-10 rounded-lg bg-teal-600/10 flex items-center justify-center mb-4 text-teal-600">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        </div>
        <h3 class="font-semibold text-navy-900 mb-1">Prendre une consultation</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Trouvez un médecin généraliste ou spécialiste près de vous.</p>
        <span class="inline-flex items-center gap-1 text-sm font-medium text-teal-600 mt-4 group-hover:gap-2 transition-all">
            Commencer <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h8m0 0L7.5 3.5M11 7l-3.5 3.5"/></svg>
        </span>
    </a>

    <a href="{{ route('patient.dossier.index') }}" class="group bg-white rounded-2xl border border-slate-100 p-6 hover:border-coral-500/30 hover:shadow-sm transition">
        <div class="w-10 h-10 rounded-lg bg-coral-500/10 flex items-center justify-center mb-4 text-coral-600">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
        </div>
        <h3 class="font-semibold text-navy-900 mb-1">Dossier médical</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Ajoutez vos symptômes, consultables par votre médecin.</p>
        <span class="inline-flex items-center gap-1 text-sm font-medium text-coral-600 mt-4 group-hover:gap-2 transition-all">
            Consulter <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h8m0 0L7.5 3.5M11 7l-3.5 3.5"/></svg>
        </span>
    </a>

    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <div class="w-10 h-10 rounded-lg bg-navy-900/5 flex items-center justify-center mb-4 text-navy-900">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
        </div>
        <h3 class="font-semibold text-navy-900 mb-1">Prochain rendez-vous</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Aucun rendez-vous prévu pour le moment.</p>
    </div>

</div>

@php
    $recents = auth()->user()->patient->symptomes()->latest()->take(3)->get();
@endphp

@if ($recents->isNotEmpty())
<div class="mt-10">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-display font-semibold text-lg text-navy-900">Derniers symptômes signalés</h3>
        <a href="{{ route('patient.dossier.index') }}" class="text-sm text-teal-600 font-medium hover:underline">Voir tout</a>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 divide-y divide-slate-100">
        @foreach ($recents as $s)
            <div class="flex items-center justify-between px-5 py-4">
                <div>
                    <p class="font-medium text-navy-900 text-sm">{{ $s->titre }}</p>
                    <p class="text-slate-500 text-xs mt-0.5">{{ $s->created_at->diffForHumans() }}</p>
                </div>
                <span @class([
                    'text-xs font-medium px-2.5 py-1 rounded-full',
                    'bg-teal-600/10 text-teal-700' => $s->gravite === 'legere',
                    'bg-coral-500/10 text-coral-700' => $s->gravite === 'moderee',
                    'bg-red-100 text-red-700' => $s->gravite === 'severe',
                ])>{{ ucfirst($s->gravite) }}</span>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection