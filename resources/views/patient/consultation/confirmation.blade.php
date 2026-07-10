@extends('layouts.dashboard')
@section('title', 'Confirmation — SuiviHealth')
@section('page-title', 'Confirmation')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-md mx-auto text-center bg-white border border-slate-100 rounded-2xl p-8">
    <div class="w-14 h-14 mx-auto rounded-full bg-teal-600/10 flex items-center justify-center text-teal-600 mb-4">
        <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg>
    </div>
    <h2 class="font-display text-xl font-semibold text-navy-900 mb-1">Paiement confirmé</h2>
    <p class="text-slate-500 text-sm mb-6">
        Votre {{ $rdv->type === 'immediat' ? 'consultation' : 'rendez-vous' }} avec {{ $rdv->medecin->user->name }} est confirmé{{ $rdv->type === 'programme' ? ' pour le '.\Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y').' à '.\Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') : '' }}.
    </p>
    <a href="{{ route('patient.dashboard') }}" class="inline-block bg-navy-900 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-navy-800 transition">
        Retour à l'accueil
    </a>
</div>
@endsection