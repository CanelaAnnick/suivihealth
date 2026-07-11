@extends('layouts.dashboard')
@section('title', 'Paiements — SuiviHealth')
@section('page-title', 'Historique des paiements')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'paiements'])
@endsection

@section('content')

<div class="bg-gradient-to-br from-navy-900 to-teal-700 rounded-2xl p-6 mb-5 text-white">
    <p class="text-[12.5px] text-white/70">Total encaissé (période filtrée)</p>
    <p class="text-[26px] font-semibold mt-1">{{ number_format($totalMontant, 0, ',', ' ') }} FCFA</p>
</div>

<form method="GET" action="{{ route('admin.paiements.index') }}" class="flex flex-wrap gap-3 mb-5 bg-white border border-slate-200 rounded-xl p-4">
    <div class="min-w-[160px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Médecin</label>
        <select name="medecin_id" onchange="this.form.submit()" class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            <option value="">Tous les médecins</option>
            @foreach ($medecins as $m)
                <option value="{{ $m->id }}" @selected(request('medecin_id') == $m->id)>{{ $m->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="min-w-[150px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Du</label>
        <input type="date" name="date_debut" value="{{ request('date_debut') }}" onchange="this.form.submit()" class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
    </div>
    <div class="min-w-[150px]">
        <label class="text-[11.5px] font-medium text-slate-500 block mb-1">Au</label>
        <input type="date" name="date_fin" value="{{ request('date_fin') }}" onchange="this.form.submit()" class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
    </div>
</form>

<x-section-card title="Transactions ({{ $transactions->count() }})">
    @forelse ($transactions as $t)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div>
                <p class="text-[13px] font-medium text-slate-900">{{ $t->patient->user->name }} → {{ $t->medecin->user->name }}</p>
                <p class="text-[12px] text-slate-400 mt-0.5">{{ ucfirst(str_replace('_', ' ', $t->moyen_paiement)) }} · {{ $t->updated_at->format('d/m/Y à H:i') }}</p>
            </div>
            <span class="text-[13px] font-semibold text-navy-900 shrink-0">{{ number_format($t->montant, 0, ',', ' ') }} FCFA</span>
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucune transaction pour ces critères.</p></div>
    @endforelse
</x-section-card>
@endsection