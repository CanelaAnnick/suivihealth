@extends('layouts.dashboard')
@section('title', 'Prendre rendez-vous — SuiviHealth')
@section('page-title', 'Rendez-vous')

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
        <div class="w-11 h-11 rounded-lg bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-semibold text-[13px]">
            {{ strtoupper(substr($medecin->user->name, 4, 2)) }}
        </div>
        <div>
            <h2 class="text-[13.5px] font-semibold text-slate-900">{{ $medecin->user->name }}</h2>
            <p class="text-[12.5px] text-slate-500">{{ $medecin->specialite }} · {{ number_format($medecin->tarif, 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <form method="POST" action="{{ route('patient.consultation.rdv.store', $medecin) }}" class="bg-white border border-slate-200 rounded-xl p-5 space-y-4">
        @csrf
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Date</label>
                <input type="date" name="date_rdv" min="{{ now()->toDateString() }}" required class="w-full mt-1 rounded-md border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('date_rdv') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Heure</label>
                <input type="time" name="heure_rdv" required class="w-full mt-1 rounded-md border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('heure_rdv') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="text-[12.5px] font-medium text-slate-700 block mb-1.5">Mode de consultation</label>
            <div class="grid grid-cols-3 gap-2.5">
                <label class="border border-slate-200 rounded-lg py-3 text-center cursor-pointer has-[:checked]:border-navy-800 has-[:checked]:bg-navy-900/5">
                    <input type="radio" name="mode" value="chat" class="hidden" required>
                    <span class="text-[12.5px] font-medium text-slate-900">Chat</span>
                </label>
                <label class="border border-slate-200 rounded-lg py-3 text-center cursor-pointer has-[:checked]:border-navy-800 has-[:checked]:bg-navy-900/5">
                    <input type="radio" name="mode" value="audio" class="hidden">
                    <span class="text-[12.5px] font-medium text-slate-900">Audio</span>
                </label>
                <label class="border border-slate-200 rounded-lg py-3 text-center cursor-pointer has-[:checked]:border-navy-800 has-[:checked]:bg-navy-900/5">
                    <input type="radio" name="mode" value="video" class="hidden">
                    <span class="text-[12.5px] font-medium text-slate-900">Vidéo</span>
                </label>
            </div>
        </div>

        <button type="submit" class="w-full bg-coral-500 text-white text-[13px] font-medium py-2.5 rounded-md hover:bg-coral-600 transition">
            Continuer vers le paiement
        </button>
    </form>
</div>
@endsection