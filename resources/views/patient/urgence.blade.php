@extends('layouts.dashboard')
@section('title', 'Urgence — SuiviHealth')
@section('page-title', 'Urgence')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => ''])
@endsection

@section('content')

<div class="max-w-2xl mx-auto text-center py-10">
    <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-navy-900 to-teal-700 flex items-center justify-center text-white mb-6">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M12 15v2m0-11v6m9-3a9 9 0 11-18 0 9 9 0 0118 0z"/><circle cx="12" cy="16.5" r="0.75" fill="currentColor"/></svg>
    </div>

    <span class="inline-flex items-center gap-1.5 bg-coral-50 text-coral-600 text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded-full mb-4">
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 1v3M9 2.5l-1.5 2M3 2.5L4.5 4.5M1 6h10M2 6l.6 5a1 1 0 001 .9h4.8a1 1 0 001-.9L10 6"/></svg>
        Fonctionnalité Premium
    </span>

    <h2 class="text-[22px] font-semibold text-slate-900 mb-3">Assistance d'urgence intelligente</h2>
    <p class="text-slate-500 text-[14px] leading-relaxed max-w-lg mx-auto mb-10">
        En mode Premium, décrivez votre situation d'urgence et notre système évalue automatiquement la gravité pour alerter en temps réel l'administration et un médecin disponible de votre hôpital — avec les numéros directs de votre établissement.
    </p>

    <div class="grid sm:grid-cols-3 gap-4 mb-10 text-left">
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="w-9 h-9 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600 mb-3">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M14.25 3.104v5.714c0 .597.237 1.169.659 1.591L19 14.5M8.5 14.5h7"/></svg>
            </div>
            <p class="text-[13px] font-semibold text-slate-900 mb-1">Évaluation par IA</p>
            <p class="text-[12px] text-slate-500">Analyse automatique de la gravité de votre situation décrite.</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="w-9 h-9 rounded-lg bg-coral-50 flex items-center justify-center text-coral-600 mb-3">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022"/></svg>
            </div>
            <p class="text-[13px] font-semibold text-slate-900 mb-1">Alerte immédiate</p>
            <p class="text-[12px] text-slate-500">Notification en temps réel à l'admin et à un médecin disponible.</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="w-9 h-9 rounded-lg bg-navy-900/5 flex items-center justify-center text-navy-800 mb-3">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M3.75 21h16.5M4.5 3h15l-.75 18h-13.5L4.5 3z"/></svg>
            </div>
            <p class="text-[13px] font-semibold text-slate-900 mb-1">Numéros de votre hôpital</p>
            <p class="text-[12px] text-slate-500">Contacts directs configurés par l'administration de votre établissement.</p>
        </div>
    </div>

    <button disabled class="bg-slate-200 text-slate-500 font-semibold px-8 py-3.5 rounded-full cursor-not-allowed">
        Passer au Premium — Bientôt disponible
    </button>
    <p class="text-[11.5px] text-slate-400 mt-4">Cette fonctionnalité sera activée avec le lancement de l'offre Premium destinée aux hôpitaux partenaires.</p>
</div>

@endsection