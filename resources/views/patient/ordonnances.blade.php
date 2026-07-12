@extends('layouts.dashboard')
@section('title', 'Ordonnances — SuiviHealth')
@section('page-title', 'Mes ordonnances')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'ordonnances'])
@endsection

@section('content')

<div class="space-y-3">
    @forelse ($ordonnances as $o)
        <div class="bg-white border border-slate-200 rounded-xl p-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4 min-w-0">
                <div class="w-11 h-11 rounded-lg bg-navy-900/5 flex items-center justify-center text-navy-800 shrink-0">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-[13.5px] font-semibold text-slate-900">Prescrite par {{ $o->medecin->user->name }}</p>
                    <p class="text-[12.5px] text-slate-500 mt-0.5">{{ $o->date_prescription->format('d/m/Y') }} · {{ Str::limit($o->medicaments, 60) }}</p>
                </div>
            </div>
            <a href="{{ route('patient.ordonnances.telecharger', $o) }}" class="shrink-0 inline-flex items-center gap-1.5 bg-navy-900 text-white text-[12.5px] font-medium px-3.5 py-2 rounded-md hover:bg-navy-800 transition">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 1v9m0 0L3.5 6.5M7 10l3.5-3.5M1 13h12"/></svg>
                Télécharger
            </a>
        </div>
    @empty
        <div class="bg-white border border-slate-200 rounded-xl py-12 text-center">
            <p class="text-slate-400 text-[13px]">Aucune ordonnance disponible pour le moment.</p>
        </div>
    @endforelse
</div>

@endsection