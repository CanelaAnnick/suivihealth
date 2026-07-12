@extends('layouts.dashboard')
@section('title', 'Confirmation — SuiviHealth')
@section('page-title', 'Confirmation')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-md mx-auto text-center bg-white border border-slate-200 rounded-lg p-7">
    <div class="w-12 h-12 mx-auto rounded-full bg-teal-50 flex items-center justify-center text-teal-600 mb-4">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg>
    </div>
    <h2 class="text-[15px] font-semibold text-slate-900 mb-1.5">Paiement confirmé</h2>
    <p class="text-slate-500 text-[13px] leading-relaxed mb-6">
        Votre {{ $rdv->type === 'immediat' ? 'consultation' : 'rendez-vous' }} avec {{ $rdv->medecin->user->name }} est confirmé{{ $rdv->type === 'programme' ? ' pour le '.\Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y').' à '.\Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') : '' }}.
    </p>
    <a href="{{ route('patient.dashboard') }}" class="inline-block bg-navy-900 text-white text-[13px] font-medium px-5 py-2.5 rounded-md hover:bg-navy-800 transition">
        Retour à l'accueil
    </a>
</div>
@endsection