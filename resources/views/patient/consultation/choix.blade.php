@extends('layouts.dashboard')
@section('title', 'Consultation — SuiviHealth')

@section('sidebar')
    <x-nav-item :route="route('patient.dashboard')" :icon="'<svg width=\'18\' height=\'18\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'1.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25\'/></svg>'">
        Accueil
    </x-nav-item>
    <x-nav-item :route="route('patient.consultation.choix')" :active="true" :icon="'<svg width=\'18\' height=\'18\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'1.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5\'/></svg>'">
        Consultation
    </x-nav-item>
    <x-nav-item :route="route('patient.dossier.index')" :icon="'<svg width=\'18\' height=\'18\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'1.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z\'/></svg>'">
        Dossier médical
    </x-nav-item>
@endsection

@section('content')
<p class="text-slate-500 mb-8">Quel type de médecin souhaitez-vous consulter ?</p>

<div class="grid md:grid-cols-2 gap-5 max-w-3xl">
    <a href="{{ route('patient.consultation.generalistes') }}" class="bg-white rounded-2xl border border-slate-100 p-8 hover:border-teal-600/30 hover:shadow-sm transition text-center">
        <div class="w-12 h-12 mx-auto rounded-xl bg-teal-600/10 flex items-center justify-center mb-4 text-teal-600">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="font-semibold text-navy-900 mb-1">Médecin généraliste</h3>
        <p class="text-slate-500 text-sm">Pour une consultation de routine ou un premier avis médical.</p>
    </a>

    <a href="{{ route('patient.consultation.specialites') }}" class="bg-white rounded-2xl border border-slate-100 p-8 hover:border-coral-500/30 hover:shadow-sm transition text-center">
        <div class="w-12 h-12 mx-auto rounded-xl bg-coral-500/10 flex items-center justify-center mb-4 text-coral-600">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4c.414 0 .75-.336.75-.75 0-.231-.035-.454-.1-.664M11.35 3.836a2.25 2.25 0 011.3-.836m-1.3.836L9 9m6-5.164a2.25 2.25 0 00-1.3-.836M15 3.836L17 9m-8 0h6m-6 0l-1.5 9.75A2.25 2.25 0 009.716 21h4.568a2.25 2.25 0 002.216-2.25L15 9"/></svg>
        </div>
        <h3 class="font-semibold text-navy-900 mb-1">Médecin spécialiste</h3>
        <p class="text-slate-500 text-sm">Pour un besoin médical précis nécessitant une expertise particulière.</p>
    </a>
</div>
@endsection