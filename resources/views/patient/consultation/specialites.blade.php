@extends('layouts.dashboard')
@section('title', 'Spécialités — SuiviHealth')
@section('page-title', 'Choisir une spécialité')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<a href="{{ route('patient.consultation.choix') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour
</a>

<p class="text-slate-500 text-[13px] mb-5">Trouvez l'expertise adaptée à votre besoin.</p>

<div class="grid sm:grid-cols-2 md:grid-cols-3 gap-3">
    @forelse ($specialites as $specialite)
        <a href="{{ route('patient.consultation.medecins', ['specialite' => $specialite]) }}" class="bg-white border border-slate-200 rounded-xl p-5 hover:border-coral-300 hover:shadow-md transition">
            <div class="w-9 h-9 rounded-lg bg-coral-50 flex items-center justify-center mb-3 text-coral-600">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4c.414 0 .75-.336.75-.75 0-.231-.035-.454-.1-.664M11.35 3.836a2.25 2.25 0 011.3-.836m-1.3.836L9 9m6-5.164a2.25 2.25 0 00-1.3-.836M15 3.836L17 9m-8 0h6m-6 0l-1.5 9.75A2.25 2.25 0 009.716 21h4.568a2.25 2.25 0 002.216-2.25L15 9"/></svg>
            </div>
            <p class="text-[13.5px] font-semibold text-slate-900">{{ $specialite }}</p>
            <span class="inline-flex items-center gap-1 text-[12px] text-navy-800 mt-2">
                Voir les médecins <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
            </span>
        </a>
    @empty
        <p class="text-slate-400 text-[13px]">Aucune spécialité disponible pour le moment.</p>
    @endforelse
</div>
@endsection