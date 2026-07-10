@extends('layouts.dashboard')
@section('title', 'Dossier médical — SuiviHealth')

@section('sidebar')
    <a href="{{ route('patient.dashboard') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Accueil</a>
    <a href="{{ route('patient.consultation.choix') }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:bg-navy-800 hover:text-white">Consultation</a>
    <a href="{{ route('patient.dossier.index') }}" class="block px-3 py-2 rounded-lg bg-navy-800 text-white">Dossier médical</a>
@endsection

@section('content')
<h1 class="font-display text-2xl font-semibold text-navy-900">Mon dossier médical</h1>
<p class="text-slate-600 mt-1">Ajoutez vos symptômes — votre médecin les consultera avant chaque rendez-vous.</p>

@if (session('status'))
    <div class="mt-4 text-sm text-teal-600 bg-teal-600/10 px-4 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="grid md:grid-cols-3 gap-8 mt-8">
    <form method="POST" action="{{ route('patient.dossier.store') }}" class="md:col-span-1 bg-white rounded-2xl border border-slate-100 p-6 space-y-4 h-fit">
        @csrf
        <h2 class="font-display font-semibold text-lg">Ajouter un symptôme</h2>
        <div>
            <label class="text-sm font-medium text-navy-900">Titre</label>
            <input type="text" name="titre" required class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600" placeholder="Ex : Maux de tête">
            @error('titre') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-sm font-medium text-navy-900">Description</label>
            <textarea name="description" rows="4" required class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600" placeholder="Décrivez ce que vous ressentez"></textarea>
            @error('description') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-sm font-medium text-navy-900">Gravité</label>
            <select name="gravite" required class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                <option value="legere">Légère</option>
                <option value="moderee">Modérée</option>
                <option value="severe">Sévère</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-coral-500 text-white font-semibold py-2.5 rounded-lg hover:bg-coral-600 transition">Ajouter</button>
    </form>

    <div class="md:col-span-2 space-y-4">
        @forelse ($symptomes as $symptome)
            <div class="bg-white rounded-2xl border border-slate-100 p-5">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-semibold text-navy-900">{{ $symptome->titre }}</h3>
                    <span @class([
                        'text-xs font-medium px-2 py-1 rounded-full',
                        'bg-teal-600/10 text-teal-600' => $symptome->gravite === 'legere',
                        'bg-coral-500/10 text-coral-600' => $symptome->gravite === 'moderee',
                        'bg-red-100 text-red-600' => $symptome->gravite === 'severe',
                    ])>{{ ucfirst($symptome->gravite) }}</span>
                </div>
                <p class="text-slate-600 text-sm">{{ $symptome->description }}</p>
                <p class="text-xs text-slate-400 mt-3">{{ $symptome->created_at->format('d/m/Y à H:i') }}</p>
            </div>
        @empty
            <p class="text-slate-500 text-sm">Aucun symptôme enregistré pour le moment.</p>
        @endforelse
    </div>
</div>
@endsection