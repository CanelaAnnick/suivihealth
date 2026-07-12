@extends('layouts.dashboard')
@section('title', 'Plaintes — SuiviHealth')
@section('page-title', 'Réclamations patients')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'plaintes'])
@endsection

@section('content')

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="space-y-3">
    @forelse ($plaintes as $p)
        <div class="bg-white border border-slate-200 rounded-xl p-5" x-data="{ open: false }">
            <div class="flex items-center justify-between cursor-pointer" @click="open = !open">
                <div>
                    <p class="text-[13.5px] font-semibold text-slate-900">{{ $p->sujet }}</p>
                    <p class="text-[12px] text-slate-500 mt-0.5">{{ $p->patient->user->name }} · {{ $p->created_at->format('d/m/Y') }}</p>
                </div>
                <span @class(['text-[11px] font-medium px-2.5 py-1 rounded-full', 'bg-amber-50 text-amber-700' => $p->statut === 'nouvelle', 'bg-sky-50 text-sky-700' => $p->statut === 'en_cours', 'bg-teal-50 text-teal-700' => $p->statut === 'resolue'])>{{ ucfirst(str_replace('_',' ',$p->statut)) }}</span>
            </div>
            <div x-show="open" x-cloak class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-[13px] text-slate-700 mb-4">{{ $p->message }}</p>
                @if ($p->rendezVous)
                    <p class="text-[12px] text-slate-400 mb-4">Concerne : {{ $p->rendezVous->medecin->user->name }} — {{ $p->rendezVous->created_at->format('d/m/Y') }}</p>
                @endif
                <form method="POST" action="{{ route('admin.plaintes.update', $p) }}" class="space-y-3">
                    @csrf @method('patch')
                    <select name="statut" class="w-full rounded-lg border-slate-200 text-[13px]">
                        <option value="nouvelle" @selected($p->statut === 'nouvelle')>Nouvelle</option>
                        <option value="en_cours" @selected($p->statut === 'en_cours')>En cours</option>
                        <option value="resolue" @selected($p->statut === 'resolue')>Résolue</option>
                    </select>
                    <textarea name="reponse_admin" rows="2" placeholder="Réponse au patient..." class="w-full rounded-lg border-slate-200 text-[13px]">{{ $p->reponse_admin }}</textarea>
                    <button type="submit" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Mettre à jour</button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white border border-slate-200 rounded-xl py-12 text-center"><p class="text-[13px] text-slate-400">Aucune réclamation.</p></div>
    @endforelse
</div>

@endsection