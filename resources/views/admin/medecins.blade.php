@extends('layouts.dashboard')
@section('title', 'Médecins — SuiviHealth')
@section('page-title', 'Médecins')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'medecins'])
@endsection

@section('content')

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="flex flex-wrap gap-3 justify-between items-end mb-5">
    <form method="GET" action="{{ route('admin.medecins.index') }}" class="flex-1 min-w-[220px]">
        <input type="text" name="recherche" value="{{ request('recherche') }}" onchange="this.form.submit()" placeholder="Rechercher un médecin..." class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
    </form>
    <a href="{{ route('admin.medecins.create') }}" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2.5 rounded-lg hover:bg-navy-800 transition inline-flex items-center gap-1.5 shrink-0">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
        Ajouter un médecin
    </a>
</div>

<x-section-card title="Tous les médecins ({{ $medecins->count() }})">
    @forelse ($medecins as $m)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($m->user->name, 4, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $m->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">{{ $m->specialite }} · {{ $m->hopital ?? 'Indépendant' }} · {{ $m->user->email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <span @class(['text-[11px] font-medium px-2 py-0.5 rounded-full', 'bg-teal-50 text-teal-700' => $m->statut === 'actif', 'bg-red-50 text-red-700' => $m->statut !== 'actif'])>{{ ucfirst($m->statut) }}</span>
                <form method="POST" action="{{ route('admin.medecins.toggle', $m) }}">
                    @csrf @method('patch')
                    <button type="submit" class="text-[12px] text-navy-800 font-medium hover:underline">
                        {{ $m->statut === 'actif' ? 'Désactiver' : 'Activer' }}
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun médecin enregistré.</p></div>
    @endforelse
</x-section-card>
@endsection