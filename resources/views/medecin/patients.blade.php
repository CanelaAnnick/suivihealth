@extends('layouts.dashboard')
@section('title', 'Mes patients — SuiviHealth')
@section('page-title', 'Mes patients')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'patients'])
@endsection

@section('content')
<x-section-card title="Patients suivis">
    @forelse ($patients as $patient)
        <a href="{{ route('medecin.patients.show', $patient) }}" class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }} hover:bg-slate-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($patient->user->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $patient->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">{{ $patient->user->email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <span class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-coral-50 text-coral-700">{{ $patient->symptomes_count }} symptôme(s)</span>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
            </div>
        </a>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun patient pour le moment.</p></div>
    @endforelse
</x-section-card>
@endsection