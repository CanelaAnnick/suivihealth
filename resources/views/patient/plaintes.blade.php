@extends('layouts.dashboard')
@section('title', 'Réclamations — SuiviHealth')
@section('page-title', 'Réclamations')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => ''])
@endsection

@section('content')

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="grid md:grid-cols-5 gap-5">
    <form method="POST" action="{{ route('patient.plaintes.store') }}" class="md:col-span-2 bg-white border border-slate-200 rounded-xl p-5 space-y-4 h-fit">
        @csrf
        <h2 class="text-[13.5px] font-semibold text-slate-900">Nouvelle réclamation</h2>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Concerne</label>
            <select name="rendez_vous_id" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                <option value="">Sélectionner une consultation</option>
                @foreach ($rendezVous as $rdv)
                    <option value="{{ $rdv->id }}">{{ $rdv->medecin->user->name }} — {{ $rdv->created_at->format('d/m/Y') }}</option>
                @endforeach
            </select>
            <p class="text-[11px] text-slate-400 mt-1">Votre réclamation sera transmise à l'hôpital concerné par cette consultation.</p>
        </div>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Sujet</label>
            <input type="text" name="sujet" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800" placeholder="Ex : Paiement non reçu par le médecin">
        </div>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Message</label>
            <textarea name="message" rows="5" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800"></textarea>
        </div>
        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Envoyer à l'administration</button>
    </form>

    <div class="md:col-span-3">
        <x-section-card title="Mes réclamations">
            @forelse ($plaintes as $p)
                <div class="px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                    <div class="flex items-center justify-between">
                        <p class="text-[13px] font-medium text-slate-900">{{ $p->sujet }}</p>
                        <span @class(['text-[11px] font-medium px-2 py-0.5 rounded-full', 'bg-amber-50 text-amber-700' => $p->statut === 'nouvelle', 'bg-sky-50 text-sky-700' => $p->statut === 'en_cours', 'bg-teal-50 text-teal-700' => $p->statut === 'resolue'])>{{ ucfirst(str_replace('_',' ',$p->statut)) }}</span>
                    </div>
                    <p class="text-[12px] text-slate-500 mt-1">{{ $p->message }}</p>
                    @if ($p->reponse_admin)
                        <div class="bg-mist rounded-lg p-3 mt-2">
                            <p class="text-[11px] font-medium text-slate-500 mb-1">Réponse de l'administration :</p>
                            <p class="text-[12px] text-slate-700">{{ $p->reponse_admin }}</p>
                        </div>
                    @endif
                    <p class="text-[11px] text-slate-400 mt-2">{{ $p->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            @empty
                <div class="px-5 py-10 text-center"><p class="text-[13px] text-slate-400">Aucune réclamation envoyée.</p></div>
            @endforelse
        </x-section-card>
    </div>
</div>

@endsection