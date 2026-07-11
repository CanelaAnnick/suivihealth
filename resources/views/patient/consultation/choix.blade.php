@extends('layouts.dashboard')
@section('title', 'Consultation — SuiviHealth')
@section('page-title', 'Consultation')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<p class="text-slate-500 text-[13px] mb-5">Quel type de médecin souhaitez-vous consulter ?</p>

<div class="grid sm:grid-cols-2 gap-3.5 max-w-2xl">
    <a href="{{ route('patient.consultation.generalistes') }}" class="bg-white border border-slate-200 rounded-xl p-6 hover:border-teal-300 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center mb-4 text-teal-600">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="text-[14px] font-semibold text-slate-900 mb-1">Médecin généraliste</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Pour une consultation de routine ou un premier avis médical.</p>
    </a>

    <a href="{{ route('patient.consultation.specialites') }}" class="bg-white border border-slate-200 rounded-xl p-6 hover:border-coral-300 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-lg bg-coral-50 flex items-center justify-center mb-4 text-coral-600">
            <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4c.414 0 .75-.336.75-.75 0-.231-.035-.454-.1-.664M11.35 3.836a2.25 2.25 0 011.3-.836m-1.3.836L9 9m6-5.164a2.25 2.25 0 00-1.3-.836M15 3.836L17 9m-8 0h6m-6 0l-1.5 9.75A2.25 2.25 0 009.716 21h4.568a2.25 2.25 0 002.216-2.25L15 9"/></svg>
        </div>
        <h3 class="text-[14px] font-semibold text-slate-900 mb-1">Médecin spécialiste</h3>
        <p class="text-slate-500 text-[12.5px] leading-relaxed">Pour un besoin médical précis nécessitant une expertise.</p>
    </a>
</div>
@endsection