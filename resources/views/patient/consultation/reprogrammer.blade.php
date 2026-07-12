@extends('layouts.dashboard')
@section('title', 'Reprogrammer — SuiviHealth')
@section('page-title', 'Reprogrammer')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'consultation'])
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white border border-slate-200 rounded-2xl p-6">
    <p class="text-[13px] text-slate-500 mb-5">Nouveau créneau avec <strong class="text-slate-900">{{ $rdv->medecin->user->name }}</strong> — aucun nouveau paiement requis.</p>

    <form method="POST" action="{{ route('patient.consultation.reprogrammer.store', $rdv) }}" class="space-y-4">
        @csrf
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Date</label>
            <input type="date" name="date_rdv" min="{{ now()->toDateString() }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
        </div>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Heure</label>
            <input type="time" name="heure_rdv" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
        </div>
        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Confirmer le nouveau créneau</button>
    </form>
</div>
@endsection