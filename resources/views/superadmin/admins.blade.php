@extends('layouts.dashboard')
@section('title', 'Administrateurs — SuiviHealth')
@section('page-title', 'Administrateurs')

@section('sidebar')
    @include('partials.sidebar-superadmin', ['active' => 'admins'])
@endsection

@section('content')

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="flex justify-end mb-5">
    <a href="{{ route('superadmin.admins.create') }}" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2.5 rounded-lg hover:bg-navy-800 transition inline-flex items-center gap-1.5">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
        Ajouter un administrateur
    </a>
</div>

<x-section-card title="Tous les administrateurs ({{ $admins->count() }})">
    @forelse ($admins as $a)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($a->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $a->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">{{ $a->email }} · {{ $a->hopital?->nom ?? 'Aucun hôpital assigné' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <span @class(['text-[11px] font-medium px-2 py-0.5 rounded-full', 'bg-teal-50 text-teal-700' => $a->actif, 'bg-red-50 text-red-700' => !$a->actif])>{{ $a->actif ? 'Actif' : 'Désactivé' }}</span>
                <form method="POST" action="{{ route('superadmin.admins.toggle', $a) }}">
                    @csrf @method('patch')
                    <button type="submit" class="text-[12px] text-navy-800 font-medium hover:underline">{{ $a->actif ? 'Désactiver' : 'Activer' }}</button>
                </form>
                <form method="POST" action="{{ route('superadmin.admins.destroy', $a) }}" onsubmit="return confirm('Supprimer cet administrateur ?')">
                    @csrf @method('delete')
                    <button type="submit" class="text-[12px] text-red-600 font-medium hover:underline">Supprimer</button>
                </form>
            </div>
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun administrateur enregistré.</p></div>
    @endforelse
</x-section-card>
@endsection