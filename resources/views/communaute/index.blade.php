@extends('layouts.dashboard')
@section('title', 'Communauté — SuiviHealth')
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

<div x-data="{ filtre: 'Tous' }">

    {{-- En-tête + recherche --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
        <div>
            <h2 class="text-[18px] font-semibold text-slate-900">Communauté</h2>
            <p class="text-slate-500 text-[13px] mt-0.5">Conseils et annonces de l'équipe médicale</p>
        </div>

        @if(in_array(auth()->user()->role, ['admin', 'medecin']))
            <a href="{{ route('communaute.creer') }}"
               class="inline-flex items-center justify-center gap-1.5 bg-teal-600 hover:bg-teal-700 text-white text-[13px] font-medium px-4 py-2 rounded-xl transition shrink-0">
                + Nouvelle publication
            </a>
        @endif
    </div>

    {{-- Barre de recherche --}}
    <div class="relative mb-4">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
            <circle cx="7" cy="7" r="5.5"/><path d="M15 15l-3.5-3.5"/>
        </svg>
        <input type="text" x-model="recherche" placeholder="Rechercher une publication..."
               class="w-full pl-10 pr-4 py-2.5 text-[13px] bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500">
    </div>

    {{-- Chips de catégorie --}}
    <div class="flex gap-2 overflow-x-auto pb-1 mb-6 -mx-1 px-1 scrollbar-hide">
        @php $categories = ['Tous', 'Conseils santé', 'Prévention', 'Annonce']; @endphp
        @foreach($categories as $cat)
            <button @click="filtre = '{{ $cat }}'"
                    class="shrink-0 text-[12.5px] font-medium px-3.5 py-1.5 rounded-full border transition"
                    :class="filtre === '{{ $cat }}' ? 'bg-navy-900 text-white border-navy-900' : 'bg-white text-slate-600 border-slate-200 hover:border-slate-300'">
                {{ $cat }}
            </button>
        @endforeach
    </div>

    @if(session('statut'))
        <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 border border-teal-100 rounded-xl px-4 py-3">
            {{ session('statut') }}
        </div>
    @endif

    @if($publications->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 px-5 py-14 text-center">
            <p class="text-[13px] text-slate-400">Aucune publication pour le moment.</p>
        </div>
    @else

        {{-- À la une : la publication la plus récente --}}
        @php $premiere = $publications->first(); @endphp
        <a href="{{ route('communaute.afficher', $premiere->id) }}"
           class="block bg-white rounded-2xl border border-slate-200 p-5 mb-4 hover:border-slate-300 transition"
           x-show="filtre === 'Tous' || filtre === '{{ $premiere->categorie }}'">

            <div class="flex items-center gap-2.5 mb-3">
                <div class="w-9 h-9 rounded-full bg-teal-50 text-teal-700 flex items-center justify-center text-[13px] font-semibold shrink-0">
                    {{ strtoupper(substr($premiere->auteur->name ?? '?', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-[13px] font-medium text-slate-900 truncate">{{ $premiere->auteur->name ?? 'Inconnu' }}</p>
                    <p class="text-slate-400 text-[11.5px]">{{ $premiere->created_at->diffForHumans() }}</p>
                </div>
                @if($premiere->categorie)
                    <span class="ml-auto text-[11px] font-medium text-teal-700 bg-teal-50 px-2.5 py-1 rounded-full shrink-0">
                        {{ $premiere->categorie }}
                    </span>
                @endif
            </div>

            <h3 class="text-[16px] font-semibold text-slate-900 mb-1.5">{{ $premiere->titre }}</h3>
            <p class="text-[13px] text-slate-500 leading-relaxed line-clamp-2">{{ Str::limit($premiere->contenu, 220) }}</p>

            @if($premiere->media_path)
                <div class="-mx-5 mt-3 aspect-video bg-slate-100 overflow-hidden">
                    @if($premiere->media_type === 'video')
                        <video controls class="w-full h-full object-cover bg-black">
                            <source src="{{ Storage::url($premiere->media_path) }}">
                        </video>
                    @else
                        <img src="{{ Storage::url($premiere->media_path) }}" alt="{{ $premiere->titre }}" class="w-full h-full object-cover">
                    @endif
                </div>
            @endif

            <p class="text-[11.5px] text-slate-400 mt-3">
                {{ $premiere->commentaires_count }} {{ Str::plural('commentaire', $premiere->commentaires_count) }}
            </p>
        </a>

        {{-- Reste des publications, en liste --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            @foreach($publications->skip(1) as $publication)
                <a href="{{ route('communaute.afficher', $publication->id) }}"
                   x-show="filtre === 'Tous' || filtre === '{{ $publication->categorie }}'"
                   class="block px-5 py-4 {{ !$loop->last ? 'border-b border-slate-100' : '' }} hover:bg-slate-50/60 transition">

                    <div class="flex items-center gap-2.5 mb-2">
                        <div class="w-8 h-8 rounded-full bg-teal-50 text-teal-700 flex items-center justify-center text-[12px] font-semibold shrink-0">
                            {{ strtoupper(substr($publication->auteur->name ?? '?', 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-[13px] font-medium text-slate-900 truncate">{{ $publication->auteur->name ?? 'Inconnu' }}</p>
                            <p class="text-slate-400 text-[11.5px]">{{ $publication->created_at->diffForHumans() }}</p>
                        </div>
                        @if($publication->categorie)
                            <span class="ml-auto text-[11px] font-medium text-teal-700 bg-teal-50 px-2 py-0.5 rounded-full shrink-0">
                                {{ $publication->categorie }}
                            </span>
                        @endif
                    </div>

                    <h3 class="text-[14px] font-semibold text-slate-900 mb-1">{{ $publication->titre }}</h3>
                    <p class="text-[12.5px] text-slate-500 leading-relaxed line-clamp-2">{{ Str::limit($publication->contenu, 160) }}</p>

                    @if($publication->media_path)
                        <div class="-mx-5 mt-2.5 aspect-video bg-slate-100 overflow-hidden">
                            @if($publication->media_type === 'video')
                                <video controls class="w-full h-full object-cover bg-black">
                                    <source src="{{ Storage::url($publication->media_path) }}">
                                </video>
                            @else
                                <img src="{{ Storage::url($publication->media_path) }}" alt="{{ $publication->titre }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                    @endif

                    <p class="text-[11.5px] text-slate-400 mt-2">
                        {{ $publication->commentaires_count }} {{ Str::plural('commentaire', $publication->commentaires_count) }}
                    </p>
                </a>
            @endforeach
        </div>

    @endif

    <div class="mt-5">
        {{ $publications->links() }}
    </div>

</div>

@endsection

@push('scripts')
<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush
