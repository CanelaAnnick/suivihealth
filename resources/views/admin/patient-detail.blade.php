@extends('layouts.dashboard')
@section('title', $patient->user->name.' — SuiviHealth')
@section('page-title', 'Dossier patient')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'patients'])
@endsection

@section('content')

<a href="{{ route('admin.patients.index') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour aux patients
</a>

<div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-2.5 mb-5">
    <p class="text-[12px] text-amber-700">Consultation à but administratif et de rapport hospitalier — lecture seule.</p>
</div>

<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-5 flex items-center justify-between flex-wrap gap-3">
    <div>
        <h2 class="text-[15px] font-semibold text-slate-900">{{ $patient->user->name }}</h2>
        <p class="text-[12.5px] text-slate-500 mt-1">
            {{ $patient->user->email }} · {{ $patient->telephone ?? 'Téléphone non renseigné' }} ·
            {{ $patient->groupe_sanguin ?? 'Groupe sanguin inconnu' }}
        </p>
    </div>
    <a href="{{ route('admin.patients.export', $patient) }}" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2.5 rounded-lg hover:bg-navy-800 transition inline-flex items-center gap-1.5 shrink-0">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 1v9m0 0L3.5 6.5M7 10l3.5-3.5M1 13h12"/></svg>
        Télécharger le dossier (PDF)
    </a>
</div>

<div class="grid md:grid-cols-2 gap-5">
    <x-section-card title="Symptômes signalés">
        @forelse ($symptomes as $s)
            <div class="px-5 py-3 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <p class="text-[13px] font-medium text-slate-900">{{ $s->titre }}</p>
                <p class="text-[12px] text-slate-500">{{ $s->created_at->format('d/m/Y') }}</p>
            </div>
        @empty
            <div class="px-5 py-8 text-center"><p class="text-[13px] text-slate-400">Aucun symptôme.</p></div>
        @endforelse
    </x-section-card>

    <x-section-card title="Consultations et rendez-vous">
        @forelse ($rendezVous as $rdv)
            <div class="px-5 py-3 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <p class="text-[13px] font-medium text-slate-900">{{ $rdv->medecin->user->name }}</p>
                <p class="text-[12px] text-slate-500">{{ ucfirst($rdv->statut) }} · {{ $rdv->created_at->format('d/m/Y') }}</p>
            </div>
        @empty
            <div class="px-5 py-8 text-center"><p class="text-[13px] text-slate-400">Aucun rendez-vous.</p></div>
        @endforelse
    </x-section-card>
</div>

@endsection