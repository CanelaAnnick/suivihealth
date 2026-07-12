@extends('layouts.dashboard')
@section('title', 'En attente — SuiviHealth')
@section('page-title', 'Consultation')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-md mx-auto text-center bg-white border border-slate-200 rounded-2xl p-8"
    x-data="{ statut: 'en_attente' }"
    x-init="setInterval(() => {
        fetch('{{ route('salle.statut', $rdv) }}').then(r => r.json()).then(d => {
            statut = d.statut;
            if (statut === 'confirme') window.location.href = '{{ route('salle.show', $rdv) }}';
        });
    }, 3000)">

    <template x-if="statut === 'en_attente'">
        <div>
            <div class="w-14 h-14 mx-auto rounded-full bg-teal-50 flex items-center justify-center text-teal-600 mb-4 animate-pulse">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
            </div>
            <h2 class="text-[15px] font-semibold text-slate-900 mb-1.5">En attente du médecin</h2>
            <p class="text-slate-500 text-[13px] leading-relaxed">Votre paiement est confirmé. {{ $rdv->medecin->user->name }} va accepter votre demande dans quelques instants.</p>
        </div>
    </template>

    <template x-if="statut === 'a_reprogrammer'">
        <div>
            <div class="w-14 h-14 mx-auto rounded-full bg-amber-50 flex items-center justify-center text-amber-600 mb-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6v6l4 2"/><circle cx="12" cy="12" r="9"/></svg>
            </div>
            <h2 class="text-[15px] font-semibold text-slate-900 mb-1.5">Médecin indisponible pour le moment</h2>
            <p class="text-slate-500 text-[13px] leading-relaxed mb-5">Votre paiement reste valide. Choisissez simplement un nouveau créneau avec ce même médecin, sans repayer.</p>
            <a href="{{ route('patient.consultation.reprogrammer', $rdv) }}" class="inline-block bg-navy-900 text-white text-[13px] font-medium px-5 py-2.5 rounded-lg hover:bg-navy-800 transition">Choisir un nouveau créneau</a>
        </div>
    </template>
</div>
@endsection