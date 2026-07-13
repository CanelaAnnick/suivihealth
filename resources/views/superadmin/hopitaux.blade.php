@extends('layouts.dashboard')
@section('title', 'Hôpitaux — SuiviHealth')
@section('page-title', 'Hôpitaux')

@section('sidebar')
    @include('partials.sidebar-superadmin', ['active' => 'hopitaux'])
@endsection

@section('content')

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="flex justify-end mb-5">
    <a href="{{ route('superadmin.hopitaux.create') }}" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2.5 rounded-lg hover:bg-navy-800 transition inline-flex items-center gap-1.5">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
        Ajouter un hôpital
    </a>
</div>

<x-section-card title="Tous les hôpitaux ({{ $hopitaux->count() }})">
    @forelse ($hopitaux as $h)
        <div class="px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $h->nom }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">{{ $h->region }} · {{ $h->medecins_count }} médecin(s)</p>
                </div>
            </div>
            @if ($h->admins->isNotEmpty())
                <p class="text-[11.5px] text-slate-500 mt-1.5">Admin : {{ $h->admins->first()->name }} ({{ $h->admins->first()->email }})</p>
            @endif
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun hôpital enregistré.</p></div>
    @endforelse
</x-section-card>
@endsection