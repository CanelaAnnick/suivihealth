@extends('layouts.dashboard')
@section('title', 'Paiement — SuiviHealth')
@section('page-title', 'Paiement')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-md mx-auto">

    <div class="bg-white border border-slate-200 rounded-xl p-5 mb-5">
        <p class="text-[11px] font-medium text-slate-400 uppercase tracking-wide mb-3">Récapitulatif</p>
        <div class="flex justify-between text-[13px] mb-2">
            <span class="text-slate-500">Médecin</span>
            <span class="font-medium text-slate-900">{{ $rdv->medecin->user->name }}</span>
        </div>
        <div class="flex justify-between text-[13px] mb-2">
            <span class="text-slate-500">Mode</span>
            <span class="font-medium text-slate-900">{{ ucfirst($rdv->mode) }}</span>
        </div>
        @if ($rdv->type === 'programme')
        <div class="flex justify-between text-[13px] mb-2">
            <span class="text-slate-500">Date</span>
            <span class="font-medium text-slate-900">{{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}</span>
        </div>
        @endif
        <div class="flex justify-between text-[13.5px] pt-3 mt-3 border-t border-slate-100">
            <span class="font-semibold text-slate-900">Total</span>
            <span class="font-semibold text-slate-900">{{ number_format($rdv->montant, 0, ',', ' ') }} FCFA</span>
        </div>
    </div>

    <form method="POST" action="{{ route('patient.consultation.paiement.confirmer', $rdv) }}">
        @csrf
        <p class="text-[13px] font-medium text-slate-900 mb-3">Moyen de paiement</p>

        <div class="space-y-2.5 mb-6">
            <label class="flex items-center gap-3 border border-slate-200 rounded-xl p-3.5 cursor-pointer has-[:checked]:border-navy-800 has-[:checked]:bg-navy-900/5">
                <input type="radio" name="moyen_paiement" value="orange_money" class="accent-navy-900" required>
                <span class="w-8 h-8 rounded-md bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-[10.5px]">OM</span>
                <span class="text-[13px] font-medium text-slate-900">Orange Money</span>
            </label>
            <label class="flex items-center gap-3 border border-slate-200 rounded-lg p-3.5 cursor-pointer has-[:checked]:border-navy-800 has-[:checked]:bg-navy-900/5">
                <input type="radio" name="moyen_paiement" value="mtn_momo" class="accent-navy-900">
                <span class="w-8 h-8 rounded-md bg-yellow-100 flex items-center justify-center text-yellow-700 font-bold text-[10.5px]">MoMo</span>
                <span class="text-[13px] font-medium text-slate-900">MTN Mobile Money</span>
            </label>
            <label class="flex items-center gap-3 border border-slate-200 rounded-lg p-3.5 cursor-pointer has-[:checked]:border-navy-800 has-[:checked]:bg-navy-900/5">
                <input type="radio" name="moyen_paiement" value="carte" class="accent-navy-900">
                <span class="w-8 h-8 rounded-md bg-teal-50 flex items-center justify-center text-teal-700">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1.75 6.417h12.5M1.75 4.25h12.5A1.083 1.083 0 0115.333 5.333v5.834a1.083 1.083 0 01-1.083 1.083H1.75a1.083 1.083 0 01-1.083-1.083V5.333A1.083 1.083 0 011.75 4.25z"/></svg>
                </span>
                <span class="text-[13px] font-medium text-slate-900">Carte bancaire</span>
            </label>
        </div>

        <button type="submit" class="w-full bg-coral-500 text-white text-[13px] font-medium py-2.5 rounded-md hover:bg-coral-600 transition">
            Payer {{ number_format($rdv->montant, 0, ',', ' ') }} FCFA
        </button>
        <p class="text-[11.5px] text-slate-400 text-center mt-3">Paiement sécurisé · Vous serez redirigé pour confirmer.</p>
    </form>
</div>
@endsection