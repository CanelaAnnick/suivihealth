@extends('layouts.dashboard')
@section('title', 'Mode de consultation — SuiviHealth')
@section('page-title', 'Consultation')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-xl">
    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
        Retour
    </a>

    <div class="flex items-center gap-3 mb-6 bg-white border border-slate-200 rounded-xl p-4">
        <div class="w-11 h-11 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center font-semibold text-[13px]">
            {{ strtoupper(substr($medecin->user->name, 4, 2)) }}
        </div>
        <div>
            <h2 class="text-[13.5px] font-semibold text-slate-900">{{ $medecin->user->name }}</h2>
            <p class="text-[12.5px] text-slate-500">{{ $medecin->specialite }} · {{ number_format($medecin->tarif, 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <form method="POST" action="{{ route('patient.consultation.consulter', $medecin) }}" x-data="{ mode: null }">
        @csrf
        <p class="text-[13px] font-medium text-slate-900 mb-3">Comment souhaitez-vous consulter ?</p>

        <div class="grid grid-cols-3 gap-2.5 mb-6">
            <button type="button" @click="mode = 'chat'" :class="mode === 'chat' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'" class="border rounded-xl p-4 text-center hover:border-navy-800 transition">
                <svg width="20" height="20" class="mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                <span class="text-[12.5px] font-medium text-slate-900">Chat</span>
            </button>
            <button type="button" @click="mode = 'audio'" :class="mode === 'audio' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'" class="border rounded-xl p-4 text-center hover:border-navy-800 transition">
                <svg width="20" height="20" class="mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.5a1.125 1.125 0 00-.852-1.09l-4.5-1.125a1.125 1.125 0 00-1.173.417l-.97 1.293a12.05 12.05 0 01-5.649-5.649l1.293-.97a1.125 1.125 0 00.417-1.173L8.09 3.102a1.125 1.125 0 00-1.09-.852h-1.5A2.25 2.25 0 003.25 4.5"/></svg>
                <span class="text-[12.5px] font-medium text-slate-900">Appel audio</span>
            </button>
            <button type="button" @click="mode = 'video'" :class="mode === 'video' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'" class="border rounded-xl p-4 text-center hover:border-navy-800 transition">
                <svg width="20" height="20" class="mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg>
                <span class="text-[12.5px] font-medium text-slate-900">Appel vidéo</span>
            </button>
        </div>

        <input type="hidden" name="mode" x-model="mode">
        <button type="submit" :disabled="!mode" :class="mode ? 'opacity-100' : 'opacity-40 cursor-not-allowed'" class="w-full bg-coral-500 text-white text-[13px] font-medium py-2.5 rounded-md hover:bg-coral-600 transition">
            Continuer vers le paiement
        </button>
    </form>
</div>
@endsection