@extends('layouts.dashboard')
@section('title', 'Rendez-vous — SuiviHealth')
@section('page-title', 'Rendez-vous')

@section('sidebar')
    @include('partials.sidebar-medecin', ['active' => 'rdv'])
@endsection

<div x-data="{ demandes: [] }" x-init="
    const charger = () => fetch('{{ route('medecin.rendezvous.demandes') }}').then(r => r.json()).then(d => demandes = d);
    charger(); setInterval(charger, 4000);
" x-show="demandes.length > 0" x-cloak class="mb-5 bg-amber-50 border border-amber-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-3 border-b border-amber-200">
        <p class="text-[13px] font-semibold text-amber-800">Demandes en attente d'acceptation</p>
    </div>
    <template x-for="d in demandes" :key="d.id">
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-amber-100 last:border-0">
            <div>
                <p class="text-[13px] font-medium text-slate-900" x-text="d.patient.user.name"></p>
                <p class="text-[12px] text-slate-500 mt-0.5" x-text="'Consultation ' + d.mode + ' immédiate'"></p>
            </div>
            <div class="flex gap-2">
                <button @click="fetch('/medecin/rendez-vous/' + d.id + '/refuser', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(() => demandes = demandes.filter(x => x.id !== d.id))" class="text-[12px] font-medium border border-slate-200 text-slate-600 px-3 py-1.5 rounded-lg hover:bg-white transition">Refuser</button>
                <button @click="fetch('/medecin/rendez-vous/' + d.id + '/accepter', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(() => window.location.href = '/salle/' + d.id)" class="text-[12px] font-medium bg-navy-900 text-white px-3 py-1.5 rounded-lg hover:bg-navy-800 transition">Accepter</button>
            </div>
        </div>
    </template>
</div>

@section('content')

<x-section-card title="Rendez-vous confirmés">
    @forelse ($confirmes as $rdv)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($rdv->patient->user->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $rdv->patient->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">
                        {{ ucfirst($rdv->mode) }} ·
                        {{ $rdv->type === 'immediat' ? 'Immédiat' : \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y').' à '.\Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}
                    </p>
                </div>
            </div>
            <a href="{{ route('salle.show', $rdv) }}" class="shrink-0 bg-navy-900 text-white text-[12px] font-medium px-3.5 py-2 rounded-lg hover:bg-navy-800 transition">
                Rejoindre
            </a>
        </div>
    @empty
        <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun rendez-vous confirmé.</p></div>
    @endforelse
</x-section-card>

<div class="mt-5">
    <x-section-card title="En attente de paiement patient">
        @forelse ($enAttente as $rdv)
            <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <p class="text-[13px] font-medium text-slate-900">{{ $rdv->patient->user->name }}</p>
                <span class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-amber-50 text-amber-700">En attente</span>
            </div>
        @empty
            <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucun rendez-vous en attente.</p></div>
        @endforelse
    </x-section-card>
</div>

@endsection