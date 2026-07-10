@extends('layouts.dashboard')
@section('title', 'Prendre rendez-vous — SuiviHealth')
@section('page-title', 'Rendez-vous')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-2xl">
    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-navy-900 mb-6">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
        Retour
    </a>

    <div class="flex items-center gap-3 mb-8">
        <div class="w-14 h-14 rounded-xl bg-navy-900 text-white flex items-center justify-center font-display font-semibold text-lg">
            {{ strtoupper(substr($medecin->user->name, 4, 2)) }}
        </div>
        <div>
            <h2 class="font-semibold text-navy-900">{{ $medecin->user->name }}</h2>
            <p class="text-sm text-slate-500">{{ $medecin->specialite }} · {{ number_format($medecin->tarif, 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <form method="POST" action="{{ route('patient.consultation.rdv.store', $medecin) }}" class="bg-white border border-slate-100 rounded-2xl p-6 space-y-5">
        @csrf
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium text-navy-900">Date</label>
                <input type="date" name="date_rdv" min="{{ now()->toDateString() }}" required class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                @error('date_rdv') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-navy-900">Heure</label>
                <input type="time" name="heure_rdv" required class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                @error('heure_rdv') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="text-sm font-medium text-navy-900 block mb-2">Mode de consultation</label>
            <div class="grid grid-cols-3 gap-3">
                <label class="border border-slate-200 rounded-xl p-4 text-center cursor-pointer has-[:checked]:border-navy-900 has-[:checked]:bg-navy-900/5">
                    <input type="radio" name="mode" value="chat" class="hidden" required>
                    <span class="text-sm font-medium text-navy-900">Chat</span>
                </label>
                <label class="border border-slate-200 rounded-xl p-4 text-center cursor-pointer has-[:checked]:border-navy-900 has-[:checked]:bg-navy-900/5">
                    <input type="radio" name="mode" value="audio" class="hidden">
                    <span class="text-sm font-medium text-navy-900">Audio</span>
                </label>
                <label class="border border-slate-200 rounded-xl p-4 text-center cursor-pointer has-[:checked]:border-navy-900 has-[:checked]:bg-navy-900/5">
                    <input type="radio" name="mode" value="video" class="hidden">
                    <span class="text-sm font-medium text-navy-900">Vidéo</span>
                </label>
            </div>
        </div>

        <button type="submit" class="w-full bg-coral-500 text-white font-semibold py-3 rounded-lg hover:bg-coral-600 transition">
            Continuer vers le paiement
        </button>
    </form>
</div>
@endsection