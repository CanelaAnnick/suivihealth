@extends('layouts.dashboard')
@section('title', 'Publication — SuiviHealth')
@section('page-title', 'Communauté')

@section('sidebar')
    @php
        $partiel = match(auth()->user()->role) {
            'patient' => 'partials.sidebar-patient',
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

<x-section-card :title="$publication->titre">
    <div class="p-5">
        <div class="flex items-center gap-2.5 mb-4">
            <div class="w-9 h-9 rounded-full bg-teal-50 text-teal-700 flex items-center justify-center text-[13px] font-semibold shrink-0">
                {{ strtoupper(substr($publication->auteur->name ?? '?', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-[13px] font-medium text-slate-900">{{ $publication->auteur->name ?? 'Inconnu' }}</p>
                <p class="text-slate-400 text-[11.5px]">{{ $publication->created_at->diffForHumans() }}</p>
            </div>

            @if($publication->auteur_id === auth()->id() || auth()->user()->role === 'admin')
                <form method="POST" action="{{ route('communaute.supprimer', $publication->id) }}" class="ml-auto"
                      onsubmit="return confirm('Supprimer cette publication ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-[11.5px] text-slate-400 hover:text-red-500">Supprimer</button>
                </form>
            @endif
        </div>

        <p class="text-[13.5px] text-slate-600 whitespace-pre-line leading-relaxed">{{ $publication->contenu }}</p>

        @if($publication->media_path)
            <div class="mt-4 rounded-xl overflow-hidden border border-slate-100">
                @if($publication->media_type === 'video')
    <video controls class="w-full max-h-[480px] bg-black">
        <source src="{{ Storage::url($publication->media_path) }}">
        Ton navigateur ne supporte pas la lecture de cette vidéo.
    </video>
@else
    <img src="{{ Storage::url($publication->media_path) }}" alt="{{ $publication->titre }}" class="w-full max-h-[480px] object-cover">
@endif
            </div>
        @endif
    </div>
</x-section-card>

<div class="mt-6">
    <h2 class="text-[13px] font-semibold text-slate-900 mb-3">
        {{ $publication->commentaires->count() }} {{ Str::plural('commentaire', $publication->commentaires->count()) }}
    </h2>

    <form method="POST" action="{{ route('communaute.commenter', $publication->id) }}" class="mb-6">
        @csrf
        <textarea name="contenu" rows="3" maxlength="1000" required
                  placeholder="Écris un commentaire..."
                  class="w-full border border-slate-200 rounded-xl p-3 text-[13px] focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-400"></textarea>
        <button type="submit"
                class="mt-2 bg-teal-600 hover:bg-teal-700 text-white text-[13px] font-medium px-4 py-2 rounded-xl transition">
            Publier le commentaire
        </button>
    </form>

    <div class="space-y-3">
        @foreach($publication->commentaires as $commentaire)
            <div class="flex gap-2.5">
                <div class="w-7 h-7 shrink-0 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-[11px] font-semibold">
                    {{ strtoupper(substr($commentaire->auteur->name ?? '?', 0, 1)) }}
                </div>
                <div class="bg-slate-50 rounded-xl px-4 py-2.5 flex-1">
                    <div class="flex items-center gap-2 mb-0.5">
                        <p class="text-[12.5px] font-medium text-slate-900">{{ $commentaire->auteur->name ?? 'Inconnu' }}</p>
                        <p class="text-slate-400 text-[11px]">{{ $commentaire->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="text-[12.5px] text-slate-600">{{ $commentaire->contenu }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection