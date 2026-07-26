@extends('layouts.dashboard')
@section('title', 'Nouvelle publication — SuiviHealth')
@section('page-title', 'Communauté')

@section('sidebar')
    @php
        $partiel = match(auth()->user()->role) {
            'medecin' => 'partials.sidebar-medecin',
            'admin' => 'partials.sidebar-admin',
            'superadmin' => 'partials.sidebar-admin',
            default => 'partials.sidebar-patient',
        };
    @endphp
    @include($partiel, ['active' => 'communaute'])
@endsection

@section('content')

<a href="{{ route('communaute.index') }}" class="text-[12.5px] text-slate-400 hover:text-teal-700 mb-5 inline-flex items-center gap-1">
    &larr; Retour à la communauté
</a>

<h2 class="text-[17px] font-semibold text-slate-900 mb-5">Nouvelle publication</h2>

@if($errors->any())
    <div class="mb-5 text-[13px] text-red-600 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $erreur)
                <li>{{ $erreur }}</li>
            @endforeach
        </ul>
    </div>
@endif

<x-section-card title="Créer une publication">
    <form method="POST" action="{{ route('communaute.stocker') }}" enctype="multipart/form-data" class="p-5 space-y-5">
        @csrf

        <div>
            <label class="block text-[12.5px] font-medium text-slate-700 mb-1.5">Titre</label>
            <input type="text" name="titre" maxlength="150" required value="{{ old('titre') }}"
                   class="w-full border border-slate-200 rounded-xl p-3 text-[13px] focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-400" />
        </div>

        <div>
            <label class="block text-[12.5px] font-medium text-slate-700 mb-1.5">Catégorie (optionnel)</label>
            <input type="text" name="categorie" maxlength="50" value="{{ old('categorie') }}"
                   placeholder="Ex: conseils, annonce, prévention"
                   class="w-full border border-slate-200 rounded-xl p-3 text-[13px] focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-400" />
        </div>

        <div>
            <label class="block text-[12.5px] font-medium text-slate-700 mb-1.5">Contenu</label>
            <textarea name="contenu" rows="8" maxlength="5000" required
                      class="w-full border border-slate-200 rounded-xl p-3 text-[13px] focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-400">{{ old('contenu') }}</textarea>
        </div>

        <div>
            <label class="block text-[12.5px] font-medium text-slate-700 mb-1.5">Photo ou vidéo (optionnel)</label>
<input type="file" name="media" accept=".jpg,.jpeg,.png,.webp,.mp4,.mov,.avi"                   class="w-full text-[12.5px] text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[12.5px] file:font-medium file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
            <p class="text-[11px] text-slate-400 mt-1">Formats acceptés : JPG, PNG, WEBP, MP4, MOV — 20 Mo maximum.</p>
        </div>

        <button type="submit"
                class="bg-teal-600 hover:bg-teal-700 text-white text-[13px] font-medium px-5 py-2.5 rounded-xl transition">
            Publier
        </button>
    </form>
</x-section-card>

@endsection
