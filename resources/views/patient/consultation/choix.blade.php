@extends('layouts.dashboard')
@section('title', 'Consultation — SuiviHealth')
@section('page-title', 'Consultation')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="text-center mb-10">
        <h2 class="text-[19px] font-semibold text-slate-900">Quel type de médecin souhaitez-vous consulter ?</h2>
        <p class="text-slate-500 text-[13.5px] mt-1.5">Choisissez le type de consultation adapté à votre besoin</p>
    </div>

    <div class="grid sm:grid-cols-2 gap-6">
        <a href="{{ route('patient.consultation.generalistes') }}" class="bg-white border border-slate-200 rounded-2xl p-8 text-center hover:border-teal-300 hover:shadow-lg hover:-translate-y-0.5 transition">
            <div class="w-16 h-16 mx-auto rounded-full bg-teal-50 flex items-center justify-center mb-5 text-teal-600">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="text-[15.5px] font-semibold text-slate-900 mb-1.5">Médecin généraliste</h3>
            <p class="text-slate-500 text-[12.5px] mb-5">Consultations courantes et premier avis médical</p>
            @if ($prixGeneraliste)
                <p class="text-[18px] font-bold text-teal-600">À partir de {{ number_format($prixGeneraliste, 0, ',', ' ') }} FCFA</p>
            @endif
        </a>

        <a href="{{ route('patient.consultation.specialites') }}" class="bg-white border border-slate-200 rounded-2xl p-8 text-center hover:border-coral-300 hover:shadow-lg hover:-translate-y-0.5 transition">
            <div class="w-16 h-16 mx-auto rounded-full bg-coral-50 flex items-center justify-center mb-5 text-coral-600">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4c.414 0 .75-.336.75-.75 0-.231-.035-.454-.1-.664M11.35 3.836a2.25 2.25 0 011.3-.836m-1.3.836L9 9m6-5.164a2.25 2.25 0 00-1.3-.836M15 3.836L17 9m-8 0h6m-6 0l-1.5 9.75A2.25 2.25 0 009.716 21h4.568a2.25 2.25 0 002.216-2.25L15 9"/></svg>
            </div>
            <h3 class="text-[15.5px] font-semibold text-slate-900 mb-1.5">Médecin spécialiste</h3>
            <p class="text-slate-500 text-[12.5px] mb-5">Experts certifiés pour un besoin précis</p>
            @if ($prixSpecialiste)
                <p class="text-[18px] font-bold text-coral-600">À partir de {{ number_format($prixSpecialiste, 0, ',', ' ') }} FCFA</p>
            @endif
        </a>
    </div>
</div>
@endsection