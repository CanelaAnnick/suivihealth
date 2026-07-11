@extends('layouts.dashboard')
@section('title', 'Ordonnances — SuiviHealth')
@section('page-title', 'Ordonnances prescrites')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'ordonnances'])
@endsection

@section('content')
<x-section-card title="Toutes mes ordonnances">
    @forelse ($ordonnances as $o)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div>
                <p class="text-[13px] font-medium text-slate-900">{{ $o->patient->user->name }}</p>
                <p class="text-[12px] text-slate-500 mt-0.5">{{ Str::limit($o->medicaments, 60) }}</p>
                <p class="text-[11px] text-slate-400 mt-0.5">{{ $o->date_prescription->format('d/m/Y') }}</p>
            </div>
            <a href="{{ route('medecin.patients.show', $o->patient) }}" class="text-[12px] text-navy-800 font-medium hover:underline shrink-0">Voir le patient</a>
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucune ordonnance prescrite pour le moment.</p></div>
    @endforelse
</x-section-card>
@endsection