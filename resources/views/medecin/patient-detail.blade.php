@extends('layouts.dashboard')
@section('title', $patient->user->name.' — SuiviHealth')
@section('page-title', 'Dossier patient')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'patients'])
@endsection

@section('content')

<a href="{{ route('medecin.patients') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour à mes patients
</a>

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-5 flex items-center justify-between flex-wrap gap-4">
    <div class="flex items-center gap-3.5">
        <div class="w-12 h-12 rounded-xl bg-navy-900/5 text-navy-800 flex items-center justify-center text-[13px] font-semibold">
            {{ strtoupper(substr($patient->user->name, 0, 2)) }}
        </div>
        <div>
            <h2 class="text-[15px] font-semibold text-slate-900">{{ $patient->user->name }}</h2>
            <p class="text-[12.5px] text-slate-500 mt-0.5">
                {{ $patient->sexe ? ($patient->sexe === 'M' ? 'Homme' : 'Femme') : 'Sexe non renseigné' }} ·
                {{ $patient->groupe_sanguin ?? 'Groupe sanguin inconnu' }} ·
                {{ $patient->telephone ?? 'Téléphone non renseigné' }}
            </p>
        </div>
    </div>
    <a href="{{ route('medecin.ordonnances.create', $patient) }}" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2.5 rounded-lg hover:bg-navy-800 transition inline-flex items-center gap-1.5">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 1v12M1 7h12"/></svg>
        Rédiger une ordonnance
    </a>
</div>

<div class="grid md:grid-cols-2 gap-5">
    <x-section-card title="Symptômes signalés">
        @forelse ($symptomes as $s)
            <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $s->titre }}</p>
                    <p class="text-[12px] text-slate-500 mt-0.5">{{ $s->description }}</p>
                    <p class="text-[11px] text-slate-400 mt-1">{{ $s->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <span @class(['text-[11px] font-medium px-2 py-0.5 rounded-full shrink-0 ml-3', 'bg-teal-50 text-teal-700' => $s->gravite === 'legere', 'bg-amber-50 text-amber-700' => $s->gravite === 'moderee', 'bg-red-50 text-red-700' => $s->gravite === 'severe'])>{{ ucfirst($s->gravite) }}</span>
            </div>
        @empty
            <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun symptôme signalé.</p></div>
        @endforelse
    </x-section-card>

    <x-section-card title="Constantes récentes">
        @forelse ($constantes as $c)
            <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <p class="text-[13px] font-medium text-slate-900">
                    {{ ucfirst($c->type) }} —
                    @if ($c->type === 'tension') {{ $c->valeur }}/{{ $c->valeur_secondaire }} mmHg
                    @else {{ $c->valeur }} {{ $c->type === 'poids' ? 'kg' : ($c->type === 'glycemie' ? 'g/L' : '°C') }}
                    @endif
                </p>
                <p class="text-[11px] text-slate-400">{{ $c->created_at->format('d/m/Y') }}</p>
            </div>
        @empty
            <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucune constante enregistrée.</p></div>
        @endforelse
    </x-section-card>
</div>

<div class="mt-5">
    <x-section-card title="Ordonnances prescrites">
        @forelse ($ordonnances as $o)
            <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ Str::limit($o->medicaments, 60) }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">{{ $o->date_prescription->format('d/m/Y') }}</p>
                </div>
            </div>
        @empty
            <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucune ordonnance prescrite à ce patient.</p></div>
        @endforelse
    </x-section-card>
</div>

@endsection