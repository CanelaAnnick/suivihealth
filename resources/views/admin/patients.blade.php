@extends('layouts.dashboard')
@section('title', 'Patients — SuiviHealth')
@section('page-title', 'Patients')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'patients'])
@endsection

@section('content')

<form method="GET" action="{{ route('admin.patients.index') }}" class="mb-5">
    <input type="text" name="recherche" value="{{ request('recherche') }}" onchange="this.form.submit()" placeholder="Rechercher un patient..." class="w-full max-w-md rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
</form>

<x-section-card title="Tous les patients ({{ $patients->count() }})">
    @forelse ($patients as $p)
        <a href="{{ route('admin.patients.show', $p) }}" class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }} hover:bg-slate-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($p->user->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $p->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">{{ $p->user->email }}</p>
                </div>
            </div>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
        </a>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun patient enregistré.</p></div>
    @endforelse
</x-section-card>
@endsection