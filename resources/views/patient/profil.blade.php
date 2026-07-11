@extends('layouts.dashboard')
@section('title', 'Mon profil — SuiviHealth')
@section('page-title', 'Mon profil')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => ''])
@endsection

@section('content')

<div class="bg-gradient-to-br from-navy-900 to-teal-700 rounded-2xl p-6 mb-6 text-white flex items-center gap-4">
    <div class="w-16 h-16 rounded-full bg-white/15 flex items-center justify-center text-[20px] font-semibold">
        {{ strtoupper(substr($user->name, 0, 2)) }}
    </div>
    <div>
        <h2 class="text-[18px] font-semibold">{{ $user->name }}</h2>
        <p class="text-white/70 text-[13px] mt-0.5">{{ $user->email }}</p>
        <span class="inline-block mt-2 text-[11px] font-medium bg-white/15 px-2.5 py-0.5 rounded-full">Patient</span>
    </div>
</div>

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="grid md:grid-cols-2 gap-5 mb-6">

    <x-section-card title="Informations du compte">
        <form method="POST" action="{{ route('profile.update') }}" class="p-5 space-y-4">
            @csrf @method('patch')
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Nom complet</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <button type="submit" class="bg-navy-900 text-white text-[13px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Enregistrer</button>
        </form>
    </x-section-card>

    <x-section-card title="Informations médicales">
        <form method="POST" action="{{ route('patient.profil.infos') }}" class="p-5 space-y-4">
            @csrf @method('patch')
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Date de naissance</label>
                    <input type="date" name="date_naissance" value="{{ auth()->user()->patient->date_naissance }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                </div>
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Sexe</label>
                    <select name="sexe" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                        <option value="">—</option>
                        <option value="M" @selected(auth()->user()->patient->sexe === 'M')>Masculin</option>
                        <option value="F" @selected(auth()->user()->patient->sexe === 'F')>Féminin</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Téléphone</label>
                <input type="text" name="telephone" value="{{ auth()->user()->patient->telephone }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Adresse</label>
                <input type="text" name="adresse" value="{{ auth()->user()->patient->adresse }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Groupe sanguin</label>
                <input type="text" name="groupe_sanguin" value="{{ auth()->user()->patient->groupe_sanguin }}" placeholder="Ex : O+" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <button type="submit" class="bg-navy-900 text-white text-[13px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Enregistrer</button>
        </form>
    </x-section-card>
</div>

<x-section-card title="Historique de mes rendez-vous et consultations">
    @forelse ($rendezVous as $rdv)
        <div class="flex items-center justify-between px-5 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center text-[11px] font-semibold shrink-0">
                    {{ strtoupper(substr($rdv->medecin->user->name, 4, 2)) }}
                </div>
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $rdv->medecin->user->name }}</p>
                    <p class="text-[12px] text-slate-400 mt-0.5">
                        {{ ucfirst($rdv->mode) }} ·
                        @if ($rdv->type === 'programme')
                            {{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}
                        @else
                            Consultation immédiate · {{ $rdv->created_at->format('d/m/Y à H:i') }}
                        @endif
                    </p>
                </div>
            </div>
            <span @class([
                'text-[11px] font-medium px-2 py-0.5 rounded-full shrink-0',
                'bg-teal-50 text-teal-700' => $rdv->statut === 'confirme',
                'bg-amber-50 text-amber-700' => $rdv->statut === 'en_attente',
                'bg-red-50 text-red-700' => $rdv->statut === 'annule',
            ])>{{ $rdv->statut === 'confirme' ? 'Confirmé' : ucfirst($rdv->statut) }}</span>
        </div>
    @empty
        <div class="px-5 py-10 text-center">
            <p class="text-[13px] text-slate-400">Aucun rendez-vous ou consultation pour le moment.</p>
        </div>
    @endforelse
</x-section-card>

@endsection