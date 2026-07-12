@extends('layouts.dashboard')
@section('title', 'Urgence — SuiviHealth')
@section('page-title', 'Urgence')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => ''])
@endsection

@section('content')

<div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-6 text-center">
    <p class="text-[13px] text-red-700 font-medium mb-4">En cas d'urgence vitale, appelez immédiatement :</p>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-2xl mx-auto">
        <a href="tel:112" class="bg-white border border-red-200 rounded-xl py-4 hover:shadow-md transition">
            <p class="text-[20px] font-bold text-red-600">112</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Urgences générales</p>
        </a>
        <a href="tel:117" class="bg-white border border-red-200 rounded-xl py-4 hover:shadow-md transition">
            <p class="text-[20px] font-bold text-red-600">117</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Police</p>
        </a>
        <a href="tel:118" class="bg-white border border-red-200 rounded-xl py-4 hover:shadow-md transition">
            <p class="text-[20px] font-bold text-red-600">118</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Pompiers</p>
        </a>
        <a href="tel:119" class="bg-white border border-red-200 rounded-xl py-4 hover:shadow-md transition">
            <p class="text-[20px] font-bold text-red-600">119</p>
            <p class="text-[11px] text-slate-500 mt-0.5">SAMU</p>
        </a>
    </div>
    <p class="text-[11px] text-red-600/70 mt-4">Numéros officiels du dispositif national d'urgence du Cameroun. Pour une urgence médicale, contactez si possible directement l'hôpital le plus proche.</p>
</div>

<x-section-card title="Hôpitaux partenaires SuiviHealth">
    @forelse ($hopitaux as $h)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M3.75 21h16.5M4.5 3h15l-.75 18h-13.5L4.5 3zM9 8.25h1.5m3 0H15"/></svg>
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $h->hopital }}</p>
                    <p class="text-[12px] text-slate-400">{{ $h->region }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun hôpital enregistré.</p></div>
    @endforelse
</x-section-card>

@endsection