@extends('layouts.dashboard')
@section('title', 'Spécialités — SuiviHealth')
@section('page-title', 'Choisir une spécialité')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<a href="{{ route('patient.consultation.choix') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-navy-900 mb-6">
    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
    Retour
</a>

<h2 class="font-display text-xl font-semibold text-navy-900 mb-1">Choisissez une spécialité</h2>
<p class="text-slate-500 text-sm mb-6">Trouvez l'expertise adaptée à votre besoin.</p>

<div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
    @forelse ($specialites as $specialite)
        <a href="{{ route('patient.consultation.medecins', ['specialite' => $specialite]) }}" class="group bg-white rounded-2xl border border-slate-100 p-6 hover:border-coral-500/30 hover:shadow-sm transition">
            <div class="w-11 h-11 rounded-xl bg-coral-500/10 flex items-center justify-center mb-4 text-coral-600">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4c.414 0 .75-.336.75-.75 0-.231-.035-.454-.1-.664M11.35 3.836a2.25 2.25 0 011.3-.836m-1.3.836L9 9m6-5.164a2.25 2.25 0 00-1.3-.836M15 3.836L17 9m-8 0h6m-6 0l-1.5 9.75A2.25 2.25 0 009.716 21h4.568a2.25 2.25 0 002.216-2.25L15 9"/></svg>
            </div>
            <p class="font-semibold text-navy-900">{{ $specialite }}</p>
            <span class="inline-flex items-center gap-1 text-xs font-medium text-coral-600 mt-3 group-hover:gap-1.5 transition-all">
                Voir les médecins <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h6m0 0L6.5 3M9 6L6.5 9"/></svg>
            </span>
        </a>
    @empty
        <p class="text-slate-500 text-sm">Aucune spécialité disponible pour le moment.</p>
    @endforelse
</div>
@endsection