@extends('layouts.dashboard')
@section('title', 'Nouvelle ordonnance — SuiviHealth')
@section('page-title', 'Nouvelle ordonnance')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'patients'])
@endsection

@section('content')

<a href="{{ route('medecin.patients.show', $patient) }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour au dossier
</a>

<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6 bg-white border border-slate-200 rounded-xl p-4">
        <div class="w-11 h-11 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center font-semibold text-[13px]">
            {{ strtoupper(substr($patient->user->name, 0, 2)) }}
        </div>
        <div>
            <h2 class="text-[13.5px] font-semibold text-slate-900"> {{ $patient->user->name }}</h2>
            <p class="text-[12.5px] text-slate-500">Nouvelle ordonnance</p>
        </div>
    </div>

    <form method="POST" action="{{ route('medecin.ordonnances.store', $patient) }}" class="bg-white border border-slate-200 rounded-xl p-5 space-y-4">
        @csrf
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Médicaments prescrits</label>
            <textarea name="medicaments" rows="5" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800" placeholder="Ex : Paracétamol 500mg — 1 comprimé 3x/jour pendant 5 jours"> {{ old('medicaments') }}</textarea>
            @error('medicaments') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Instructions (optionnel)</label>
            <textarea name="instructions" rows="3" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800" placeholder="Ex : Prendre après les repas"> {{ old('instructions') }}</textarea>
        </div>
        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Créer l'ordonnance</button>
    </form>
</div>

@endsection