@props(['medecin', 'label' => null])

<div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col sm:flex-row gap-4 hover:border-teal-300 hover:shadow-md transition">

    <div class="flex items-start gap-3.5 flex-1 min-w-0">
        @if ($medecin->user->photo)
        <img src="{{ asset('uploads/'.$medecin->user->photo) }}" class="w-12 h-12 rounded-lg object-cover shrink-0">
        @else
            <div class="w-12 h-12 rounded-lg bg-navy-900/5 text-navy-800 flex items-center justify-center font-semibold text-[13px] shrink-0">
                {{ strtoupper(substr($medecin->user->name, 4, 2)) }}
            </div>
        @endif

        <div class="min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
                <h3 class="text-[13.5px] font-semibold text-slate-900">{{ $medecin->user->name }}</h3>
                <span class="inline-flex items-center gap-1 text-[10.5px] font-medium text-teal-700 bg-teal-50 px-1.5 py-0.5 rounded-full">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Vérifié
                </span>
                @if ($medecin->disponible_immediat)
                    <span class="inline-flex items-center gap-1 text-[10.5px] font-medium text-teal-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> Disponible maintenant
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 text-[10.5px] font-medium text-slate-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span> Hors ligne
                    </span>
                @endif
            </div>
            <p class="text-[12.5px] text-slate-500 mt-0.5">{{ $label ?? $medecin->specialite }}</p>
            <p class="text-[12px] text-slate-400 mt-1 flex items-center gap-1">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M6.5 11.917A4.417 4.417 0 106.5 3.083a4.417 4.417 0 000 8.834zM6.5 11.917V12.5"/></svg>
                {{ $medecin->hopital ?? 'Cabinet indépendant' }} · {{ $medecin->region }}
            </p>
            <p class="text-[13px] font-semibold text-navy-900 mt-2">{{ number_format($medecin->tarif, 0, ',', ' ') }} FCFA <span class="font-normal text-slate-400 text-[11.5px]">/ consultation</span></p>
        </div>
    </div>

    <div class="flex sm:flex-col gap-2 shrink-0 sm:w-[136px]">
        <button type="button"
            @if ($medecin->disponible_immediat)
                @click="$dispatch('open-consultation', { medecinId: {{ $medecin->id }}, nom: @js($medecin->user->name), specialite: @js($label ?? $medecin->specialite), tarif: {{ $medecin->tarif }}, flow: 'consulter' })"
                class="flex-1 text-center text-[12.5px] font-medium bg-navy-900 text-white py-2 rounded-lg hover:bg-navy-800 transition"
            @else
                disabled title="Ce médecin n'est pas disponible pour une consultation immédiate"
                class="flex-1 text-center text-[12.5px] font-medium bg-slate-100 text-slate-400 py-2 rounded-lg cursor-not-allowed"
            @endif
        >
            Consulter
        </button>
        <button type="button"
            @click="$dispatch('open-consultation', { medecinId: {{ $medecin->id }}, nom: @js($medecin->user->name), specialite: @js($label ?? $medecin->specialite), tarif: {{ $medecin->tarif }}, flow: 'rdv' })"
            class="flex-1 text-center text-[12.5px] font-medium border border-slate-200 text-slate-700 py-2 rounded-lg hover:bg-mist transition">
            Rendez-vous
        </button>
    </div>
</div>