@extends('layouts.dashboard')
@section('title', 'Dossier médical — SuiviHealth')
@section('page-title', 'Dossier médical')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'dossier'])
@endsection

@section('content')
<p class="text-slate-500 text-[13px] mb-6">Ajoutez vos symptômes — votre médecin les consultera avant chaque rendez-vous.</p>
<a href="{{ route('patient.dossier.export') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-navy-800 font-medium hover:underline mb-4">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 1v9m0 0L3.5 6.5M7 10l3.5-3.5M1 13h12"/></svg>
    Télécharger mon dossier complet (PDF)
</a>

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-md inline-block">{{ session('status') }}</div>
@endif

<div class="grid md:grid-cols-5 gap-5">

    <form method="POST" action="{{ route('patient.dossier.store') }}" class="md:col-span-2 bg-white border border-slate-200 rounded-xl p-5 space-y-4 h-fit">
        @csrf
        <h2 class="text-[13.5px] font-semibold text-slate-900">Ajouter un symptôme</h2>

        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Titre</label>
            <input type="text" name="titre" required class="w-full mt-1 rounded-md border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800" placeholder="Ex : Maux de tête">
            @error('titre') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Description</label>
            <textarea name="description" rows="4" required class="w-full mt-1 rounded-md border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800" placeholder="Décrivez ce que vous ressentez"></textarea>
            @error('description') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700 block mb-1.5">Gravité</label>
            <div class="grid grid-cols-3 gap-2">
                <label class="border border-slate-200 rounded-xl py-2 text-center text-[12.5px] font-medium cursor-pointer has-[:checked]:border-teal-600 has-[:checked]:bg-teal-50 has-[:checked]:text-teal-700">
                    <input type="radio" name="gravite" value="legere" class="hidden" checked>Légère
                </label>
                <label class="border border-slate-200 rounded-xl py-2 text-center text-[12.5px] font-medium cursor-pointer has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:text-amber-700">
                    <input type="radio" name="gravite" value="moderee" class="hidden">Modérée
                </label>
                <label class="border border-slate-200 rounded-xl text-center text-[12.5px] font-medium cursor-pointer has-[:checked]:border-red-500 has-[:checked]:bg-red-50 has-[:checked]:text-red-700">
                    <input type="radio" name="gravite" value="severe" class="hidden">Sévère
                </label>
            </div>
        </div>
        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-md hover:bg-navy-800 transition">Ajouter</button>
    </form>

    <div class="md:col-span-3 space-y-2.5">
        @forelse ($symptomes as $symptome)
            <div class="bg-white border border-slate-200 rounded-xl p-4">
                <div class="flex items-center justify-between mb-1.5">
                    <h3 class="text-[13.5px] font-semibold text-slate-900">{{ $symptome->titre }}</h3>
                    <span @class([
                        'text-[11px] font-medium px-2 py-0.5 rounded shrink-0',
                        'bg-teal-50 text-teal-700' => $symptome->gravite === 'legere',
                        'bg-amber-50 text-amber-700' => $symptome->gravite === 'moderee',
                        'bg-red-50 text-red-700' => $symptome->gravite === 'severe',
                    ])>{{ ucfirst($symptome->gravite) }}</span>
                </div>
                <p class="text-slate-600 text-[12.5px] leading-relaxed">{{ $symptome->description }}</p>
                <p class="text-[11.5px] text-slate-400 mt-2.5">{{ $symptome->created_at->format('d/m/Y à H:i') }}</p>
                <form method="POST" action="{{ route('patient.dossier.destroy', $symptome) }}" onsubmit="return confirm('Supprimer ce symptôme ?')" class="mt-2">
                    @csrf @method('delete')
                    <button type="submit" class="text-[11px] text-red-600 font-medium hover:underline">Supprimer</button>
                </form>
            </div>
        @empty
            <div class="bg-white border border-slate-200 rounded-xl py-10 text-center">
                <p class="text-slate-400 text-[13px]">Aucun symptôme enregistré pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>

<a href="{{ route('patient.carnet.export') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-navy-800 font-medium hover:underline mt-8 mb-2">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 1v9m0 0L3.5 6.5M7 10l3.5-3.5M1 13h12"/></svg>
    Télécharger mon carnet de santé complet (PDF)
</a>

<div class="grid md:grid-cols-2 gap-5 mt-6">

    <x-section-card title="Allergies connues">
        <form method="POST" action="{{ route('patient.dossier.allergies') }}" class="p-5 space-y-3">
            @csrf @method('patch')
            <textarea name="allergies" rows="3" placeholder="Ex : Pénicilline, arachides..." class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">{{ $patient->allergies }}</textarea>
            <button type="submit" class="bg-navy-900 text-white text-[12.5px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Enregistrer</button>
        </form>
    </x-section-card>

    <x-section-card title="Vaccinations">
        <form method="POST" action="{{ route('patient.vaccinations.store') }}" class="p-5 space-y-3 border-b border-slate-100">
            @csrf
            <div class="grid grid-cols-2 gap-2">
                <input type="text" name="nom_vaccin" required placeholder="Nom du vaccin" class="rounded-lg border-slate-200 text-[12.5px] focus:border-navy-800 focus:ring-navy-800">
                <input type="date" name="date_administration" required class="rounded-lg border-slate-200 text-[12.5px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <input type="date" name="date_rappel" placeholder="Date de rappel (optionnel)" class="w-full rounded-lg border-slate-200 text-[12.5px] focus:border-navy-800 focus:ring-navy-800">
            <button type="submit" class="bg-teal-600 text-white text-[12.5px] font-medium px-4 py-2 rounded-lg hover:bg-teal-700 transition">Ajouter le vaccin</button>
        </form>
        @forelse ($vaccinations as $v)
            <div class="flex items-center justify-between px-5 py-3 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                <div>
                    <p class="text-[13px] font-medium text-slate-900">{{ $v->nom_vaccin }}</p>
                    <p class="text-[11.5px] text-slate-400">{{ $v->date_administration->format('d/m/Y') }} @if($v->date_rappel) · Rappel le {{ $v->date_rappel->format('d/m/Y') }} @endif</p>
                </div>
                <form method="POST" action="{{ route('patient.vaccinations.destroy', $v) }}" onsubmit="return confirm('Supprimer ce vaccin ?')">
                    @csrf @method('delete')
                    <button type="submit" class="text-[11px] text-red-600 font-medium hover:underline">Supprimer</button>
                </form>
            </div>
        @empty
            <div class="px-5 py-6 text-center"><p class="text-[12.5px] text-slate-400">Aucun vaccin enregistré.</p></div>
        @endforelse
    </x-section-card>

</div>
@endsection