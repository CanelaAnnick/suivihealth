@extends('layouts.dashboard')
@section('title', 'Rendez-vous — SuiviHealth')
@section('page-title', 'Rendez-vous')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'rdv'])
@endsection

@section('content')

<x-section-card title="Rendez-vous confirmés">
    @forelse ($confirmes as $rdv)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($rdv->patient->user->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $rdv->patient->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">
                        {{ ucfirst($rdv->mode) }} ·
                        {{ $rdv->type === 'immediat' ? 'Immédiat' : \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y').' à '.\Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}
                    </p>
                </div>
            </div>
            <a href="{{ route('salle.show', $rdv) }}" class="shrink-0 bg-navy-900 text-white text-[12px] font-medium px-3.5 py-2 rounded-lg hover:bg-navy-800 transition">
                Rejoindre
            </a>
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun rendez-vous confirmé.</p></div>
    @endforelse
</x-section-card>

<div class="mt-5">
    <x-section-card title="En attente de paiement patient">
        @forelse ($enAttente as $rdv)
            <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <p class="text-[13px] font-medium text-slate-900">{{ $rdv->patient->user->name }}</p>
                <span class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-amber-50 text-amber-700">En attente</span>
            </div>
        @empty
            <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun rendez-vous en attente.</p></div>
        @endforelse
    </x-section-card>
</div>

@endsection